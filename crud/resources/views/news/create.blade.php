<!DOCTYPE html>
<html lang="en">
<head>
    <title>Add New News</title>
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
        <div class="col-md-9 content">

            <div style="padding: 10px 0;">Add News Form</div>

            <form method="post" action="{{route('news.store')}}">
                @csrf
                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="title">
                </div>

                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" class="form-control-file" name="image" id="image">
                </div>

                <div class="form-group">
                    <label for="newsDescription">News Editor</label>
                    <textarea class="form-control" id="newsDescription" name="newsDescription" rows="3"></textarea>
                </div>

                <div class="form-group">
                    <label for="publishedDate">Published Date</label>
                    <input type="text" class="form-control" id="publishedDate" name="publishedDate" placeholder="publishedDate">
                </div>

                <div class="form-group">
                    <label for="author">Author</label>
                    <input type="text" class="form-control" id="author" name="author" placeholder="author">
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
        <div class="col-md-3 content">
            <div class="row"></div>
            <div class="row">

                <h3 class="col-md-12">Categories</h3>

                <ul style="list-style: none; padding: 0;">
                    <?php foreach($categories as $category){?>
                        <li class="col-md-12">
                            <input type="checkbox" name="categories" value="<?=$category->id?>">
                            <?=$category->Display_name?>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>

</div>

</body>
</html>
