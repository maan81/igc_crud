<!DOCTYPE html>
<html lang="en">
<head>
    <title>List News</title>
    <link rel="stylesheet" type="text/css" href="//stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- <script type="text/javascript" src="//stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script> -->
    <!-- <script type="text/javascript" src="//stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.bundle.min.js"></script> -->
    <style type="text/css">
        body{
            background: #f0f0ff;
        }
        ol.breadcrumb{
            background: none;
        }
        .page-header{
            margin-right: 10px;
            padding-right: 10px;
        }
        .header-description{
            margin-top: 15px;
            position: absolute;
        }
    </style>
</head>
<body>

<div class="container">

    <div class="row">
        <div class="col-md-9">
            <h2 class="page-header float-left">Page Header</h2>
            <small class="header-description">Optional Description</small>
        </div>

        <div class="pull-right">
            <nav aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="/">Home</a>
                </li>
                <li class="breadcrumb-item active" aria-current="page">
                    News
                </li>
              </ol>
            </nav>
        </div>
    </div>


    <div class="row">
        <div class="col-md-9">

            <a href="/news/add" class="btn btn-default float-right">Add</a>

            <table class="table">
                <thead>
                    <tr>
                        <!-- title
                        content
                        Highlights
                        author
                        Publish_date
                        category_id ---- Unique id of category row
                        category_name -- Category of news eg. Sports, featured news, politics, entertainment
                        created_at
                        updated_at
                        deleted_at -->

                        <th scope="col">ID</th>
                        <th scope="col">Title</th>
                        <th scope="col">Author</th>
                        <th scope="col">Category</th>
                        <th scope="col">Publish At</th>
                        <th scope="col">Created At</th>
                        <th scope="col">#</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($news as $each)
                        <tr>
                            <th scope="row"><?=$each->id?></th>
                            <td>
                                <a href="<?=URL::action('NewsController@show',['id' => $each->id])?>">
                                    <?=$each->title?>
                                </a>
                            </td>
                            <td><?=$each->author?></td>
                            <td><?=$each->Publish_date?></td>
                            <td><?=$each->created_at?></td>
                            <td><?=$each->updated_at?></td>
                            <td>
                                <a href="<?=URL::action('NewsController@edit',['id' => $each->id])?>">
                                    Edit
                                </a>

                                {!! Form::open(['method' => 'Delete', 'route' => ['news.destroy', $each->id]]) !!}
                                    <button type="submit" class="btn btn-link"
                                        onclick="return confirm('Are you sure you want to delete <?=$each->title?> ?')"
                                    >Delete</button>
                                {!! Form::close() !!}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
        <div class="col-md-3">right content</div>
    </div>

</div>

</body>
</html>
