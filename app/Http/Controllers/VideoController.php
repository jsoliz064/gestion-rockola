<?php

namespace App\Http\Controllers;

use App\Models\ListaReproduccion;
use App\Models\PedidoDetalle;
use App\Models\Video;
use App\Traits\ResponseTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use GuzzleHttp\Client;

class VideoController extends Controller
{
    use ResponseTrait;
    public function index()
    {
        return view('cruds.video.index');
    }

    public function searchVideos(Request $request)
    {
        $query = $request->input('query');
        if (!$query) {
            return response()->json(['error' => 'Query parameter is required'], 400);
        }

        $apiKey = config('app.YOUTUBE_API_KEY');

        $client = new Client();
        $searchUrl = 'https://www.googleapis.com/youtube/v3/search';
        $videoDetailsUrl = 'https://www.googleapis.com/youtube/v3/videos';

        try {
            // Paso 1: Buscar videos
            $searchResponse = $client->request('GET', $searchUrl, [
                'query' => [
                    'part' => 'snippet',
                    'q' => $query,
                    'key' => $apiKey,
                    'maxResults' => 10,
                    'type' => 'video',
                    'videoCategoryId' => '10', // Categoría de música
                ]
            ]);

            $searchResults = json_decode($searchResponse->getBody()->getContents(), true);
            $videoIds = collect($searchResults['items'])->pluck('id.videoId')->join(',');

            // Paso 2: Obtener detalles de los videos, incluida la duración
            $videosResponse = $client->request('GET', $videoDetailsUrl, [
                'query' => [
                    'part' => 'contentDetails,snippet',
                    'id' => $videoIds,
                    'key' => $apiKey
                ]
            ]);

            $videoDetails = json_decode($videosResponse->getBody()->getContents(), true);
            $filteredVideos = collect($videoDetails['items'])->filter(function ($video) {
                $duration = new \DateInterval($video['contentDetails']['duration']);
                $durationInSeconds = ($duration->h * 3600) + ($duration->i * 60) + $duration->s;
                return $durationInSeconds <= 300; // 5 minutos = 300 segundos
            });

            $savedVideos = [];
            foreach ($filteredVideos as $video) {
                $videoFind = Video::where('videoId', $video['id'])->first();
                if ($videoFind == null) {
                    $savedVideos[] = Video::create([
                        'videoId' => $video['id'],
                        'title' => $video['snippet']['title'],
                        'duration' => $video['contentDetails']['duration'],
                        'thumbnails_default' => $video['snippet']['thumbnails']['default']['url'],
                        'thumbnails_medium' => $video['snippet']['thumbnails']['medium']['url'],
                        'thumbnails_high' => $video['snippet']['thumbnails']['high']['url']
                    ]);
                }
            }

            return response()->json($savedVideos);
        } catch (\Throwable $th) {
            $message = $th->getMessage();
            return response()->json(['error' => "An error occurred while fetching videos, {$message}"], 500);
        }
    }

    public function getAll()
    {
        $videos = Video::all();
        return response()->json($videos, 200);
    }

    public function getSalaPlaylist(Request $request)
    {
        try {
            $pedido = $request->pedido;
            $sala = $pedido->sala;
            $playlist = ListaReproduccion::select(
                'lista_reproduccion.id',
                'lista_reproduccion.created_at',
                'videos.title',
                'videos.thumbnails_default',
                'videos.thumbnails_medium',
                'videos.thumbnails_heigh',
                'videos.duration',
                'mesas.nombre as mesa'
            )
                ->where('lista_reproduccion.sala_id', $sala->id)
                ->join('videos', 'videos.id', 'lista_reproduccion.video_id')
                ->join('mesas', 'mesas.id', 'lista_reproduccion.mesa_id')
                ->orderby('created_at', 'asc')
                ->get();
            return response()->json($playlist, 200);
        } catch (\Throwable $th) {
            return $this->ResponseThrow($th);
        }
    }

    public function addVideo(Request $request)
    {
        try {
            $this->ValidatorRequest($request->all(), [
                'videoId' => 'required|string'
            ]);

            $pedido = $request->pedido;

            $video = Video::where('videoId', $request->videoId)->first();
            if ($video == null) {
                return $this->ResponseError('Video no encontrado', 400);
            }

            $pedidoDetalle = DB::transaction(function () use ($video, $pedido) {
                $pedidoDetalle = PedidoDetalle::create([
                    'video_id' => $video->id,
                    'pedido_id' => $pedido->id
                ]);

                ListaReproduccion::create([
                    'video_id' => $video->id,
                    'sala_id' => $pedido->Mesa->Sala->id,
                    'mesa_id' => $pedido->Mesa->id
                ]);

                return $pedidoDetalle;
            });

            return response()->json($pedidoDetalle);
        } catch (\Throwable $th) {
            return $this->ResponseThrow($th);
        }
    }

    public function getLastVideo()
    {
        $video = ListaReproduccion::select(
            'lista_reproduccion.id',
            'videos.videoId',
            'videos.title',
            'videos.duration',
            'mesas.nombre as mesa'
        )
            ->join('videos', 'videos.id', 'lista_reproduccion.video_id')
            ->join('mesas', 'mesas.id', 'lista_reproduccion.mesa_id')
            ->orderby('lista_reproduccion.created_at', 'asc')
            ->first();
        return response()->json($video, 200);
    }
}
