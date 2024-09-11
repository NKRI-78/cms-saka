<?php

namespace App\Controllers\Admin;

use App\Controllers\Base\BaseController;
use Config\Services;

class CategoryController extends BaseController
{
    public function index()
    {
        $result = curlHelper(getenv('ECOMMERCE_URL') . '/ecommerces/v1/products/category/all', 'GET');
        $data["category"] = $result->data;

        return view("admin/category/index", $data);
    }

    public function create()
    {
        $result = curlHelper(getenv('API_URL') . '/commerce-service/category', 'GET');
        $data["category"] = $result->data;

        return view("admin/category/create", $data);
    }

    public function post()
    {
        $session = Services::session();
        $client = new \GuzzleHttp\Client();
        $request = Services::request();

        $name = $request->getPost('name');
        $parent = $request->getPost('parent');

        if (isset($_FILES['image'])) {
            $url = getenv('API_URL') . '/commerce-service/upload';
            $options = [
                'multipart' => [
                    [
                        'name' => 'file',
                        'contents' => fopen($_FILES['image']['tmp_name'], 'r'),
                        'filename' => $_FILES['image']['name']
                    ],
                ],
            ];

            $req = $client->post($url, $options);
            $response = $req->getBody()->getContents();
            $result = json_decode($response);
            $contentType = $result->data->contentType;
            $path = $result->data->path;
            $fileLength = $result->data->fileLength;
            $originalName = $result->data->originalName;
        }

        $url = getenv('API_URL') . '/commerce-service/category';
        $data = [
            "name" => $name,
            "contentType" => $contentType,
            "path" => $path,
            "fileLength" => $fileLength,
            "originalName" => $originalName,
            "oid" => $parent
        ];

        $req = $client->post(
            $url,
            [
                "body" => json_encode($data),
                'headers' =>  [
                    'Authorization' => 'Bearer ' . $session->get('token'),
                    'Content-Type'        => 'application/json',
                ]
            ]
        );
        $response = $req->getBody()->getContents();
        $result = json_decode($response);
    }

    public function edit($categoryId)
    {
        $result = curlHelper(getenv('API_URL') . '/commerce-service/category?categoryId=' . $categoryId, 'GET');
        $all = curlHelper(getenv('API_URL') . '/commerce-service/category', 'GET');
        $data["category"] = $result->data;
        $data["all"] = $all->data;

        return view("admin/category/edit", $data);
    }

    public function update()
    {
        $session = Services::session();
        $client = new \GuzzleHttp\Client();
        $request = Services::request();

        $categoryId = $request->getPost('categoryId');
        $name = $request->getPost('name');
        $parent = $request->getPost('parent');

        if (isset($_FILES['image']) == false) {
            $result = curlHelper(getenv('API_URL') . '/commerce-service/category?categoryId=' . $categoryId, 'GET');
            $contentType = $result->data[0]->picture->contentType;
            $path = $result->data[0]->picture->path;
            $fileLength = $result->data[0]->picture->fileLength;
            $originalName = $result->data[0]->picture->originalName;
        }

        if (isset($_FILES['image'])) {
            $url = getenv('API_URL') . '/commerce-service/upload';
            $options = [
                'multipart' => [
                    [
                        'name' => 'file',
                        'contents' => fopen($_FILES['image']['tmp_name'], 'r'),
                        'filename' => $_FILES['image']['name']
                    ],
                ],
            ];

            $req = $client->post($url, $options);
            $response = $req->getBody()->getContents();
            $result = json_decode($response);
            $contentType = $result->data->contentType;
            $path = $result->data->path;
            $fileLength = $result->data->fileLength;
            $originalName = $result->data->originalName;
        }

        $url = getenv('API_URL') . '/commerce-service/category?categoryId=' . $categoryId;
        $data = [
            "name" => $name,
            "contentType" => $contentType,
            "path" => $path,
            "fileLength" => $fileLength,
            "originalName" => $originalName,
            "oid" => $parent,
            "status" => 1
        ];

        $req = $client->put(
            $url,
            [
                "body" => json_encode($data),
                'headers' =>  [
                    'Authorization' => 'Bearer ' . $session->get('token'),
                    'Content-Type'        => 'application/json',
                ]
            ]
        );
    }

    public function delete($categoryId)
    {
        $session = Services::session();
        $client = new \GuzzleHttp\Client();

        $url = getenv('API_URL') . '/commerce-service/category?categoryId=' . $categoryId;
        $result = curlHelper($url, 'GET');

        $parent = "";
        if (isset($result->data[0]->parent->{'$id'})) {
            $parent = $result->data[0]->parent->{'$id'};
        }

        $data = [
            "name" => $result->data[0]->name,
            "contentType" => $result->data[0]->picture->contentType,
            "path" => $result->data[0]->picture->path,
            "fileLength" => $result->data[0]->picture->fileLength,
            "originalName" => $result->data[0]->picture->originalName,
            "oid" =>  $parent,
            "status" => 0
        ];

        $req = $client->put(
            $url,
            [
                "body" => json_encode($data),
                'headers' =>  [
                    'Authorization' => 'Bearer ' . $session->get('token'),
                    'Content-Type'        => 'application/json',
                ]
            ]
        );

        return redirect()->to(base_url('admin/category'));
    }

    public function detail($categoryId)
    {
        $result = curlHelper(getenv('API_URL') . '/commerce-service/category?categoryId=' . $categoryId, 'GET');

        return json_encode([
            "data" => $result->data
        ]);
    }
}
