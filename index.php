<?php
$title = "Available songs";
$path = "./";
$angular = "";
?>
<?php include "inc/head.php";?>
          <main class="main" data-ng-app="myApp" data-ng-controller="ListController">
            <section class="songListContainer col-md-8">
                <h1><?php echo $title; ?></h1>
                <p>Songs in <strong class="topSong">orange</strong> are in the top 200 requested songs</p>
               <form>
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="filter">Search</label>
                                <div class="input-group">
                                    <div class="input-group-addon"><i class="fa fa-search"></i></div>
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
         <!--
                        <div class="col-md-12">
                            <div class="checkbox">
                                <label>
                                    <input data-ng-model="topSongs" type="checkbox" value="">Top Songs only
                                </label>
                            </div>
                        </div>
          -->
                    </div>
                </form>
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th class="col-md-1">Add</th>
                                <th>
                                    <a href="#" data-ng-click="sortType = 'Song'; sortReverse = !sortReverse">
                                        Song
                                        <span data-ng-show="sortType == 'Song' && !sortReverse" class="fa fa-chevron-down"></span>
                                        <span data-ng-show="sortType == 'Song' && sortReverse" class="fa fa-chevron-up"></span>
                                    </a>
                                </th>
                                <th>
                                    <a href="#" data-ng-click="sortType = 'Artist'; sortReverse = !sortReverse">
                                        Artist
                                        <span data-ng-show="sortType == 'Artist' && !sortReverse" class="fa fa-chevron-down"></span>
                                        <span data-ng-show="sortType == 'Artist' && sortReverse" class="fa fa-chevron-up"></span>
                                    </a>
                                </th>
                                <th>
                                    <a href="#" data-ng-click="sortType = 'Genre'; sortReverse = !sortReverse">
                                        Genre
                                        <span data-ng-show="sortType == 'Genre' && !sortReverse" class="fa fa-chevron-down"></span>
                                        <span data-ng-show="sortType == 'Genre' && sortReverse" class="fa fa-chevron-up"></span>
                                    </a>
                                </th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <td colspan="4"><a class="btn btn-default" href="#" data-toggle="modal" data-target="#instructions">Instructions</a></td>
                            </tr>
                        </tfoot>
                        <tbody>
                            <tr dir-paginate="songs in tracks
                                | orderBy:sortType:sortReverse
                                | filter:search
                                | filter:genre
                                | filter:topSongs
                                | itemsPerPage: 30"
                                data-ng-class="{topSong:songs.TopSong}">
                                <td><a class="btn btn-default btn-sm" href="" role="button" data-ng-click="selectSong(songs)"><span class="fa fa-plus"></span></a></td>
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
            <section class="submitList col-md-4 fixed-right">
               <div class="panel panel-default">
                    <h2 class="panel-heading">Selected Songs</h2>
                    <div class="panel-body">
                        <ul class="list-unstyled">
                        <li data-ng-repeat="addedSongs in addedTracks | orderBy:sortType:sortReverse"><a class="btn btn-default" href="#" role="button" data-ng-click="removeSong(addedSongs)"><i class="fa fa-trash fa-2x"></i></a> {{ addedSongs.Song }}</li>
                        </ul>
                    </div>
                    <div class="panel-footer">
                        <form action="submit.php" method="post">
                        <select class="hidden" name="selectedSongForm[]" id="selectedSongForm" multiple>
                            <option data-ng-repeat="optionSongs in addedTracks" value="{{ optionSongs.Song }} - {{ optionSongs.Artist }}" selected="selected">{{ optionSongs.Song }}</option>
                        </select>
                            <div class="form-group">
                                <label for="email">Email address</label>
                                <input class="form-control" name="email" id="email" type="email" placeholder="Enter your email" required="required" />
                            </div>
                            <div class="text-center">
                                <button class="btn btn-primary" data-ng-class="{disabled: addedTracks.length === 0}" type="reset" data-ng-click="clearSelectedSongs()">Clear</button>
                                <button class="btn btn-primary" data-ng-class="{disabled: addedTracks.length === 0}" type="submit">Submit</button>
                            </div>
                        </form>
                    </div>
                </div>
            </section>

        <!-- Instructions modal -->

            <section class="modal fade" id="instructions" tabindex="-1" role="dialog" aria-labelledby="instructionsLabel">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h2 class="modal-title" id="instructionsLabel">Instructions</h2>
                  </div>
                  <div class="modal-body">
                    <h3>Adding songs to your list</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur maiores, nam, ipsa laudantium voluptatibus officiis iusto illo officia suscipit deserunt maxime asperiores quisquam aliquam, mollitia incidunt eaque accusantium debitis, praesentium?</p>
                    <h3>Removing songs from your list</h3>
                     <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur maiores, nam, ipsa laudantium voluptatibus officiis iusto illo officia suscipit deserunt maxime asperiores quisquam aliquam, mollitia incidunt eaque accusantium debitis, praesentium?</p>
                   <h3>Submitting your list</h3>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Pariatur maiores, nam, ipsa laudantium voluptatibus officiis iusto illo officia suscipit deserunt maxime asperiores quisquam aliquam, mollitia incidunt eaque accusantium debitis, praesentium?</p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </section>

        <!-- /Instructions modal -->
        </main>

<?php include "inc/foot.php";?>