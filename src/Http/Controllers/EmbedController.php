<?php

namespace PixiiBomb\Essentials\Http\Controllers;

use Illuminate\Support\Facades\Response;
use Illuminate\View\View;
use Illuminate\Http\Request;
use PixiiBomb\Essentials\Models\Content;
use PixiiBomb\Essentials\Models\Meta;
use PixiiBomb\Essentials\Models\Vector;
use PixiiBomb\Essentials\View\Components\Container;

class EmbedController extends ContentController
{
    function index(): View
    {
        $meta = new Meta('Embed into OpenAI');
        $scripts = ['embed'];

        $containers = [
            (new Container())
                ->setAlias('Embed Index')
                ->setFilename($this->localContent('embed'))
        ];

        $content = new Content($meta, $containers, $scripts);

        return parent::view($content);
    }

    function chat()
    {
        $meta = new Meta('Pixii Chat');
        $scripts = ['chat'];

        $containers = [
            (new Container())
                ->setAlias('Embed Index')
                ->setFilename($this->localContent('chat'))
        ];

        $content = new Content($meta, $containers, $scripts);

        return parent::view($content);
    }

    function post(Request $request)
    {
        return "You said {$request->input('uin')}";
    }

    function create(Request $request)
    {
        $apiKey = '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';
        $url = 'https://api.openai.com/v1/embeddings';
        $uin = $request->input('uin');

        $data = array(
            'model' => 'text-embedding-ada-002',
            'input' => $uin,
        );

        $options = array(
            'http' => array(
                'header' =>
                    "Content-Type: application/json\r\n" .
                    "Authorization: Bearer {$apiKey}\r\n",
                'method'  => 'POST',
                'content' => json_encode($data),
            ),
        );

        $context = stream_context_create($options);
        $openai = file_get_contents($url, false, $context);


        if ($openai === false) { // Request failed
            return $openai;
        } else { // Request succeeded

            $api = json_decode($openai, true);
            $embed = $api['data'][0]['embedding'];

            // Insert data into the 'vectors' table
            $vector = new Vector();
            $vector->alias = $request->input('alias');
            $vector->uin = $request->input('uin');
            $vector->vector = json_encode($embed);
            $vector->save();

            return "Added to vectors table<br>".var_dump($embed);
        }
    }
}
