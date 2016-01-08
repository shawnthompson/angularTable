<?php
$title = "Available Songs";
$path = "./";
$angular = "";
?>
<?php include "./inc/head.php"; ?>
<main class="main" data-ng-app="myApp" data-ng-controller="ListControllerJSONP">
    <section class="songListContainer container">
        <h1><?php echo $title; ?></h1>
        <p>Songs in <strong class="topSong">orange</strong> are in the top 200 requested songs</p>
        <form>
            <div class="row">
                <div class="col-md-8">
                    <div class="form-group">
                        <label for="filter">Search</label>
                        <div class="input-group">
                            <div class="input-group-addon"><i class="glyphicon glyphicon-search"></i></div>
                            <input type="text" id="filter" name="filter" class="form-control" placeholder="Search for a song or artist" data-ng-model="search">
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="genre">Genre</label>
                        <select class="form-control" id="genre" name="genre" data-ng-model="genre">
                            <option value="" selected="selected">All genres</option>
                            <option data-ng-repeat="songs in tracks | unique: 'Genre'" value="{{songs.Genre}}">{{songs.Genre}}</option>
                        </select>
                    </div>
                </div>
            </div>
        </form>
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>
                            <a href="#" data-ng-click="sortType = 'Song'; sortReverse = !sortReverse">
                                Song
                                <span data-ng-show="sortType == 'Song' && !sortReverse" class="glyphicon glyphicon-chevron-down"></span>
                                <span data-ng-show="sortType == 'Song' && sortReverse" class="glyphicon glyphicon-chevron-up"></span>
                            </a>
                        </th>
                        <th>
                            <a href="#" data-ng-click="sortType = 'Artist'; sortReverse = !sortReverse">
                                Artist
                                <span data-ng-show="sortType == 'Artist' && !sortReverse" class="glyphicon glyphicon-chevron-down"></span>
                                <span data-ng-show="sortType == 'Artist' && sortReverse" class="glyphicon glyphicon-chevron-up"></span>
                            </a>
                        </th>
                        <th>
                            <a href="#" data-ng-click="sortType = 'Genre'; sortReverse = !sortReverse">
                                Genre
                                <span data-ng-show="sortType == 'Genre' && !sortReverse" class="glyphicon glyphicon-chevron-down"></span>
                                <span data-ng-show="sortType == 'Genre' && sortReverse" class="glyphicon glyphicon-chevron-up"></span>
                            </a>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr dir-paginate="songs in tracks
                        | orderBy:sortType:sortReverse
                        | filter:search
                        | filter:genre
                        | filter:topSongs
                        | itemsPerPage: 30"
                        data-ng-class="{topSong:songs.TopSong}">
                        <td>{{ songs.Song }}</td>
                        <td>{{ songs.Artist }}</td>
                        <td>{{ songs.Genre }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="text-center">
            <dir-pagination-controls></dir-pagination-controls>
        </div>
    </section>

</main>
<?php include "./inc/foot.php"; ?>