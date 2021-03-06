<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
	    <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="Proyecto de prueba Daily Trends">
        <meta name="author" content="Jesús Rosaleny">
        
	    <title>Welcome to Daily Trends</title>
	    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" integrity="sha384-WskhaSGFgHYWDcbwN70/dfYBj47jz9qbsMId/iRN3ewGhXQFZCSftd1LZCfmhktB" crossorigin="anonymous">
	    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:700,900" rel="stylesheet">
	    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css" integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">
	    <style>
            #brand, .brand {
                font-family: 'Playfair';
                font-weight: 900;
                font-size: 2em;
            }
            
            #brand a {
                color: #0d0d0d;
            }
            
            .nav .nav-item {
                text-transform: uppercase;
                font-weight: 700;
            }
            
            .nav-item a {
                color: #0d0d0d;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="nav-scroller py-1 mb-2">
                <nav class="nav d-flex justify-content-between">
                    <div class="col-md-3 float-left" id="brand">
                        <a href="<?php echo base_url('feed'); ?>" class="nav-link">
                            Daily Trends
                        </a>
                    </div>
                    <div class="col-md-6 float-right border-bottom">
                        <ul class="nav">
                            <li class="nav-item p-2">
                                <a href="<?php echo base_url('feed'); ?>" class="nav-link" style="color: #0d0d0d">
                                    <i class="fa fa-home"></i>
                                    Home
                                </a>
                            </li>
                            <li class="nav-item p-2">
                                <a href="<?php echo base_url('feed/list'); ?>" class="nav-link">
                                    <i class="fa fa-folder"></i>
                                    List
                                </a>
                            </li>
                            <li class="nav-item p-2">
                                <a href="<?php echo base_url('feed/create'); ?>" class="nav-link">
                                    <i class="fa fa-plus"></i>
                                    Add
                                </a>
                            </li>
                            <li class="nav-item p-2">
                                <a href="<?php echo base_url(); ?>" class="nav-link">
                                    <i class="fa fa-rss"></i>
                                    Subscribe
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
            <div class="row my-5">
                <div class="col-md-12">
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">Title</th>
                                <th scope="col">Description</th>
                                <th scope="col">Publisher</th>
                                <th scope="col">Date</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($feeds as $feed) {
                                echo "<tr>";
                                    echo "<td>" . $feed->title . "</td>";
                                    echo "<td>" . $feed->body . "</td>";
                                    echo "<td>" . $feed->publisher . "</td>";
                                    echo "<td>" . $feed->date . "</td>";
                                    echo "<td>"
                                            ."<a href=". base_url('feed/edit/' . $feed->id) .">"
                                                ."<i class='fa fa-edit'></i>"
                                            ."</a>"
                                            ." | "
                                            ."<a href=". base_url('feed/delete/' . $feed->id) .">"
                                                ."<i class='fa fa-trash'></i></td>"
                                            ."</a>";
                                echo "</tr>";
                            } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </body>
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</html>