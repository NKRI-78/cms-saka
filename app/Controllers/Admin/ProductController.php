<?php

namespace App\Controllers\Admin;

use App\Controllers\Base\BaseController;
use Config\Services;

class ProductController extends BaseController
{
    public function index()
    {
        return view("admin/product/index");
    }

    public function getData()
    {
        $limit = $_POST['length'];
        $start = $_POST['start'];

        $page = $start / $limit + 1;

        if (empty($_POST['search']['value'])) {
            $result = curlHelper(getenv('ECOMMERCE_URL') . '/ecommerces/v1/products/all?page=' . $page . '&limit=' . $limit . '&search=&app_name=saka&cat=', 'GET');
            $recordsTotal = intval($result->data->page_detail->total);
        } else {
            $search = $_POST['search']['value'];
            $search = str_replace(" ", "%20", $search);
            $result = curlHelper(getenv('ECOMMERCE_URL') . '/ecommerces/v1/products/all?page=' . $page . '&limit=' . $limit . '&search=' . $search . '&app_name=saka&cat=', 'GET');
            $recordsTotal = intval($result->data->page_detail->total);
        }

        $data = array();
        $no = 1;

        function formatRupiah($amount)
        {
            return 'Rp ' . number_format($amount, 0, ',', '.');
        }

        if (!empty($result)) {
            foreach ($result->data->products as $row) {
                $nestedData['no'] = $no++;
                $nestedData['name'] = $row->title;
                $nestedData['stok'] = $row->stock;
                $nestedData['category'] = $row->category->name;
                $nestedData['price'] = formatRupiah($row->price);
                $nestedData['action'] =
                    '
                    <div class="send-panel">
                        <label class="ml-2 mb-0 iq-bg-primary rounded">
                        <a href="' . base_url("admin/product/edit/$row->id") . '" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit News">
                            <i class="ri-edit-line text-primary"></i>
                        </a>
                        </label>
                        <label class="ml-2 mb-0 iq-bg-primary rounded">
                            <a onclick="DetailProduct(\'' . $row->id . '\')" data-toggle="tooltip" data-placement="top" title="" data-original-title="Show Detail">
                                <i class="ri-list-check-2 text-primary"></i>
                            </a>
                        </label>
                        <label class="ml-2 mb-0 iq-bg-primary rounded">
                            <a onclick="DeleteProduct(\'' . $row->id . '\')" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete Product">
                                <i class="ri-delete-bin-line text-primary"></i>
                            </a>
                        </label>
                    </div>';
                $data[] = $nestedData;
            }
        }

        return json_encode([
            "draw"            => intval($_POST['draw']),
            "recordsTotal"    => $recordsTotal,
            "recordsFiltered" => $recordsTotal,
            "data"            => $data
        ]);
    }

    public function create()
    {
        $client = new \GuzzleHttp\Client();
        $session = Services::session();
        $request = Services::request();

        $session = session();
        $user_id = $session->get('userId');

        $postData = [
            'user_id' => $user_id
        ];

        $url = getenv('ECOMMERCE_URL') . '/ecommerces/v1/stores';

        try {
            $response = $client->post(
                $url,
                [
                    "body" => json_encode($postData),
                    'headers' =>  [
                        'Authorization' => 'Bearer ' . $session->get('token'),
                        'Accept'        => 'application/json',
                        'Content-Type'  => 'application/json',
                    ]
                ]
            );

            $resultStore = json_decode($response->getBody(), true);
        } catch (\Exception $e) {
            return $e->getMessage();
        }

        $result = curlHelper(getenv('ECOMMERCE_URL') . '/ecommerces/v1/products/category/all', 'GET');
        $resultApp = curlHelper(getenv('ECOMMERCE_URL') . '/apps/v1/all', 'GET');

        $data["category"] = $result->data;
        $data["app"] = $resultApp->data;
        $data["store"] = $resultStore['data'];

        return view("admin/product/create", $data);
    }

    // public function post()
    // {
    //     $client = new \GuzzleHttp\Client();
    //     $session = Services::session();
    //     $request = Services::request();

    //     $product_id = $request->getPost('productId');
    //     $app_id = $request->getPost('app_id');
    //     $store_id = $request->getPost('store_id');
    //     $title = $request->getPost('title');
    //     $price = $request->getPost('price');
    //     $stock = $request->getPost('stock');
    //     $weight = $request->getPost('weight');
    //     $category = $request->getPost('category');
    //     $caption = $request->getPost('caption');

    //     // if ($_FILES['image']) {
    //     //     $bodyImage = [
    //     //         "folder" => "saka",
    //     //         "subfolder" => "product",
    //     //         "media" => $_FILES['image']
    //     //     ];

    //     //     $result = curlImageHelper('https://api-media.inovatiftujuh8.com/api/v1/media/upload', $bodyImage);
    //     // }

    //     // $path = isset($_FILES['image']) ? $result->data->path : '';

    //     $imagePaths = [];

    //     if (!empty($_FILES['images'])) {
    //         foreach ($_FILES['images']['tmp_name'] as $key => $tmpName) {
    //             $file = new \CURLFile($tmpName, $_FILES['images']['type'][$key], $_FILES['images']['name'][$key]);

    //             $bodyImage = [
    //                 "folder" => "saka",
    //                 "subfolder" => "product",
    //                 "media" => $file
    //             ];

    //             // $result = curlImageHelper('https://api-media.inovatiftujuh8.com/api/v1/media/upload', $bodyImage);

    //             // if (isset($result->data->path)) {
    //             //     $imagePaths[] = $result->data->path;
    //             // }

    //             $ch = curl_init('https://api-media.inovatiftujuh8.com/api/v1/media/upload');
    //             curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //             curl_setopt($ch, CURLOPT_POST, true);
    //             curl_setopt($ch, CURLOPT_POSTFIELDS, $bodyImage); // POSTFIELDS harus berupa array dengan objek CURLFile
    //             $response = curl_exec($ch);

    //             // Handle error
    //             if (curl_errno($ch)) {
    //                 echo 'Error:' . curl_error($ch);
    //             }
    //             curl_close($ch);

    //             $result = json_decode($response);

    //             // Periksa apakah path berhasil diupload dan simpan
    //             if (isset($result->data->path)) {
    //                 $imagePaths[] = $result->data->path;
    //             }
    //         }
    //     }

    //     $url = getenv('ECOMMERCE_URL') . '/ecommerces/v1/products/store';

    //     $body = [
    //         "id" => $product_id,
    //         "title" => $title,
    //         "caption" => $caption,
    //         "price" => $price,
    //         "weight" => $weight,
    //         "stock" => $stock,
    //         "is_draft" => 0,
    //         "cat_id" => $category,
    //         "app_id" => $app_id,
    //         "store_id" => $store_id,
    //     ];

    //     $req = $client->post(
    //         $url,
    //         [
    //             "body" => json_encode($body),
    //             'headers' =>  [
    //                 'Authorization' => 'Bearer ' . $session->get('token'),
    //                 'Accept'        => 'application/json',
    //                 'Content-Type' => 'application/json'
    //             ]
    //         ]
    //     );

    //     $imageUrl = getenv('ECOMMERCE_URL') . '/ecommerces/v1/products/store/image';
    //     foreach ($imagePaths as $path) {
    //         $body = [
    //             "product_id" => $product_id,
    //             "path" => $path,
    //         ];

    //         $client->post(
    //             $imageUrl,
    //             [
    //                 "body" => json_encode($body),
    //                 'headers' => [
    //                     'Authorization' => 'Bearer ' . $session->get('token'),
    //                     'Accept'        => 'application/json',
    //                     'Content-Type'  => 'application/json'
    //                 ]
    //             ]
    //         );
    //     }
    // }

    public function post()
    {
        $client = new \GuzzleHttp\Client();
        $session = Services::session();
        $request = Services::request();

        $product_id = $request->getPost('productId');
        $app_id = $request->getPost('app_id');
        $store_id = $request->getPost('store_id');
        $title = $request->getPost('title');
        $price = $request->getPost('price');
        $stock = $request->getPost('stock');
        $weight = $request->getPost('weight');
        $category = $request->getPost('category');
        $caption = $request->getPost('caption');

        $imagePaths = [];

        if (!empty($_FILES['images'])) {
            foreach ($_FILES['images']['tmp_name'] as $key => $tmpName) {
                try {

                    // Using Guzzle to upload image
                    $response = $client->post('https://api-media.inovatiftujuh8.com/api/v1/media/upload', [
                        'multipart' => [
                            [
                                'name' => 'folder',
                                'contents' => 'saka'
                            ],
                            [
                                'name' => 'subfolder',
                                'contents' => 'product'
                            ],
                            [
                                'name' => 'media',
                                'contents' => fopen($tmpName, 'r'),
                                'filename' => $_FILES['images']['name'][$key],
                                'headers'  => ['Content-Type' => $_FILES['images']['type'][$key]]
                            ]
                        ]
                    ]);

                    $result = json_decode($response->getBody()->getContents());

                    // Check if the path is successfully uploaded
                    if (isset($result->data->path)) {
                        $imagePaths[] = $result->data->path;
                    }
                } catch (\Exception $e) {
                    // Handle any errors that occur during the image upload
                    echo 'Error uploading image: ' . $e->getMessage();
                }
            }
        }

        try {
            // Prepare the body for the product data
            $url = getenv('ECOMMERCE_URL') . '/ecommerces/v1/products/store';

            $body = [
                "id" => $product_id,
                "title" => $title,
                "caption" => $caption,
                "price" => $price,
                "weight" => $weight,
                "stock" => $stock,
                "is_draft" => 0,
                "cat_id" => $category,
                "app_id" => $app_id,
                "store_id" => $store_id,
            ];

            // Post product data
            $response = $client->post($url, [
                "body" => json_encode($body),
                'headers' => [
                    'Authorization' => 'Bearer ' . $session->get('token'),
                    'Accept'        => 'application/json',
                    'Content-Type'  => 'application/json'
                ]
            ]);

            // Post the uploaded image paths
            $imageUrl = getenv('ECOMMERCE_URL') . '/ecommerces/v1/products/store/image';

            foreach ($imagePaths as $path) {
                $body = [
                    "product_id" => $product_id,
                    "path" => $path,
                ];

                $client->post($imageUrl, [
                    "body" => json_encode($body),
                    'headers' => [
                        'Authorization' => 'Bearer ' . $session->get('token'),
                        'Accept'        => 'application/json',
                        'Content-Type'  => 'application/json'
                    ]
                ]);
            }
        } catch (\Exception $e) {
            // Handle any errors that occur during the product data post
            echo 'Error posting product data: ' . $e->getMessage();
        }
    }

    public function edit($productId)
    {
        $result = curlHelper(getenv('ECOMMERCE_URL') . '/ecommerces/v1/products/detail/' . $productId, 'GET');
        $resultCategory = curlHelper(getenv('ECOMMERCE_URL') . '/ecommerces/v1/products/category/all', 'GET');

        $data["product"] = $result->data->product;
        $data["category"] = $resultCategory->data;

        // var_dump($data); die;

        return view("admin/product/edit", $data);
    }

    // public function update()
    // {
    //     $client = new \GuzzleHttp\Client();
    //     $session = Services::session();
    //     $request = Services::request();

    //     $product_id = $request->getPost('productId');
    //     $imageOld = $request->getPost('imageOld');
    //     $title = $request->getPost('title');
    //     $price = $request->getPost('price');
    //     $stock = $request->getPost('stock');
    //     $weight = $request->getPost('weight');
    //     $category = $request->getPost('category');
    //     $caption = $request->getPost('caption');
    //     $imageId = $request->getPost('imageId');

    //     $imagePaths = [];

    //     if (!empty($_FILES['images'])) {
    //         foreach ($_FILES['images']['tmp_name'] as $key => $tmpName) {
    //             $file = new \CURLFile($tmpName, $_FILES['images']['type'][$key], $_FILES['images']['name'][$key]);

    //             $bodyImage = [
    //                 "folder" => "saka",
    //                 "subfolder" => "product",
    //                 "media" => $file
    //             ];

    //             // $result = curlImageHelper('https://api-media.inovatiftujuh8.com/api/v1/media/upload', $bodyImage);

    //             // if (isset($result->data->path)) {
    //             //     $imagePaths[] = $result->data->path;
    //             // }

    //             $ch = curl_init('https://api-media.inovatiftujuh8.com/api/v1/media/upload');
    //             curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    //             curl_setopt($ch, CURLOPT_POST, true);
    //             curl_setopt($ch, CURLOPT_POSTFIELDS, $bodyImage);
    //             $response = curl_exec($ch);

    //             if (curl_errno($ch)) {
    //                 echo 'Error:' . curl_error($ch);
    //             }
    //             curl_close($ch);

    //             $result = json_decode($response);

    //             // Periksa apakah path berhasil diupload dan simpan
    //             if (isset($result->data->path)) {
    //                 $imagePaths[] = $result->data->path;
    //             }
    //         }
    //     }

    //     $url = getenv('ECOMMERCE_URL') . '/ecommerces/v1/products/update/' . $product_id;

    //     $body = [
    //         "title" => $title,
    //         "description" => $caption,
    //         "price" => $price,
    //         "weight" => $weight,
    //         "stock" => $stock,
    //         "is_draft" => 0,
    //         "cat_id" => $category,
    //     ];

    //     $req = $client->put(
    //         $url,
    //         [
    //             "body" => json_encode($body),
    //             'headers' =>  [
    //                 'Authorization' => 'Bearer ' . $session->get('token'),
    //                 'Accept'        => 'application/json',
    //                 'Content-Type' => 'application/json'
    //             ]
    //         ]
    //     );

    //     $imageUrl = getenv('ECOMMERCE_URL') . '/ecommerces/v1/products/store/image';

    //     foreach ($imagePaths as $path) {
    //         $body = [
    //             "product_id" => $product_id,
    //             "path" => $path,
    //         ];

    //         $client->post(
    //             $imageUrl,
    //             [
    //                 "body" => json_encode($body),
    //                 'headers' => [
    //                     'Authorization' => 'Bearer ' . $session->get('token'),
    //                     'Accept'        => 'application/json',
    //                     'Content-Type'  => 'application/json'
    //                 ]
    //             ]
    //         );
    //     }
    // }

    public function update()
    {
        $client = new \GuzzleHttp\Client();
        $session = Services::session();
        $request = Services::request();

        $product_id = $request->getPost('productId');
        $imageOld = $request->getPost('imageOld');
        $title = $request->getPost('title');
        $price = $request->getPost('price');
        $stock = $request->getPost('stock');
        $weight = $request->getPost('weight');
        $category = $request->getPost('category');
        $caption = $request->getPost('caption');
        $imageId = $request->getPost('imageId');

        $imagePaths = [];

        // Upload new images if available
        if (!empty($_FILES['images'])) {
            foreach ($_FILES['images']['tmp_name'] as $key => $tmpName) {
                try {
                    $response = $client->post('https://api-media.inovatiftujuh8.com/api/v1/media/upload', [
                        'multipart' => [
                            [
                                'name' => 'folder',
                                'contents' => 'saka'
                            ],
                            [
                                'name' => 'subfolder',
                                'contents' => 'product'
                            ],
                            [
                                'name' => 'media',
                                'contents' => fopen($tmpName, 'r'),
                                'filename' => $_FILES['images']['name'][$key],
                                'headers'  => ['Content-Type' => $_FILES['images']['type'][$key]]
                            ]
                        ]
                    ]);

                    $result = json_decode($response->getBody()->getContents());

                    // Save the path if the image upload was successful
                    if (isset($result->data->path)) {
                        $imagePaths[] = $result->data->path;
                    }
                } catch (\Exception $e) {
                    // Handle upload error
                    echo 'Error uploading image: ' . $e->getMessage();
                }
            }
        }

        try {
            // Update the product details
            $url = getenv('ECOMMERCE_URL') . '/ecommerces/v1/products/update/' . $product_id;

            $body = [
                "title" => $title,
                "description" => $caption,
                "price" => $price,
                "weight" => $weight,
                "stock" => $stock,
                "is_draft" => 0,
                "cat_id" => $category,
            ];

            // Send the PUT request to update product data
            $response = $client->put($url, [
                "body" => json_encode($body),
                'headers' => [
                    'Authorization' => 'Bearer ' . $session->get('token'),
                    'Accept'        => 'application/json',
                    'Content-Type'  => 'application/json'
                ]
            ]);
        } catch (\Exception $e) {
            // Handle error during the product update
            echo 'Error updating product: ' . $e->getMessage();
        }

        // Upload the images associated with the product
        $imageUrl = getenv('ECOMMERCE_URL') . '/ecommerces/v1/products/store/image';

        foreach ($imagePaths as $path) {
            try {
                $body = [
                    "product_id" => $product_id,
                    "path" => $path,
                ];

                $client->post($imageUrl, [
                    "body" => json_encode($body),
                    'headers' => [
                        'Authorization' => 'Bearer ' . $session->get('token'),
                        'Accept'        => 'application/json',
                        'Content-Type'  => 'application/json'
                    ]
                ]);
            } catch (\Exception $e) {
                // Handle error during image upload
                echo 'Error uploading image path: ' . $e->getMessage();
            }
        }
    }

    public function detail($productId)
    {
        $result = curlHelper(getenv('ECOMMERCE_URL') . '/ecommerces/v1/products/detail/' . $productId, 'GET');

        return json_encode([
            "data" =>  $result->data->product
        ]);
    }

    public function delete($productId)
    {
        $client = new \GuzzleHttp\Client();
        $session = Services::session();

        $url = getenv('ECOMMERCE_URL') . '/ecommerces/v1/products/delete/' . $productId;

        $req = $client->delete(
            $url,
            [
                'headers' =>  [
                    'Authorization' => 'Bearer ' . $session->get('token'),
                    'Accept'        => 'application/json',
                ]
            ]
        );

        return redirect()->to(base_url('admin/product'));
    }

    public function deleteImage()
    {
        $client = new \GuzzleHttp\Client();
        $session = Services::session();
        $request = Services::request();

        $imageId = $request->getPost('imageId');

        $url = getenv('ECOMMERCE_URL') . '/ecommerces/v1/delete-product-image';

        $body = [
            "id" => $imageId,
        ];

        $req = $client->delete(
            $url,
            [
                "body" => json_encode($body),
                'headers' =>  [
                    'Authorization' => 'Bearer ' . $session->get('token'),
                    'Accept'        => 'application/json',
                    'Content-Type' => 'application/json'
                ]
            ]
        );
    }
}
