<?php
include_once( 'conf.php' );
include_once( 'comments.php' );
if ( isset( $_POST[ 'action' ] ) ) {
    switch ( $_POST[ 'action' ] ) {
        case "post":
            if ( !isset( $_POST[ 'media' ] ) ) {
                if ( !isset( $_POST[ 'id' ] ) ) {
                    post( base64_decode( $_COOKIE[ 'PHP7SESSION' ] ) );
                } else {
                    post( $_POST[ 'id' ] );
                }
            } else {
                postmedia( base64_decode( $_COOKIE[ 'PHP7SESSION' ] ) );
            }

            break;
        case "edit":
            $id = $_POST[ 'id_post' ];
            $post = $_POST[ 'post' ];
            editpost( $id, $post );
            break;
        case "del":
            $id = $_POST[ 'id_post' ];
            delpost( $id );
            break;
    }
}
if ( isset( $_POST[ 'id' ] ) ) {

}
if ( !isset( $_POST[ 'id' ] ) && !isset( $_POST[ 'action' ] ) ) {
    //GetMyMural();
}
if ( !isset( $_POST[ 'action' ] ) && isset( $_POST[ 'id' ] ) ) {
    //GetMural($_POST['id']);
}

function postedbyme( $id, $id_post ) {
    $sqlquery = "SELECT * FROM post WHERE poster='{$id}' AND id_post='{$id_post}';";
    $rd = mysqli_query( getDB(), $sqlquery );
    while ( $ar = mysqli_fetch_array( $rd ) ) {
        return true;
    }
    return false;
}

function delpost( $id_post ) {
    if ( strcmp( $id_post, "" ) != 0 ) {
        $instruccion = "delete from post where id_post='{$id_post}';";
        $r2 = mysqli_query( getDB(), $instruccion );
        $instruccion2 = "delete from comment where id_post_com='{$id_post}';";
        $r = mysqli_query( getDB(), $instruccion2 );
        echo '¡Publicación Eliminada!';
    } else {
        echo "Faltan datos!";
    }

}

function editpost( $id_post, $new_post ) {
    if ( strcmp( $id_post, "" ) != 0 ) {
        $instruccion = "Update post set post='" . $new_post . "' where 
id_post=" . $id_post . ";";
        $r2 = mysqli_query( getDB(), $instruccion );
        echo '¡Publicación Editada!';
    } else {
        echo "Faltan datos!";
    }
}

function post( $to_post ) {
    $my_id = base64_decode( $_COOKIE[ 'PHP7SESSION' ] );
    $post = $_POST[ 'post_text' ];
    if ( strcmp( $my_id, "" ) != 0 ) {
        $sqlquery = "INSERT INTO post(owner,poster,post,date,media) SELECT '{$to_post}','{$my_id}','{$post}',DATE_FORMAT(NOW(),'%d/%m/%Y') as datetoday,'ada';";
        $r = mysqli_query( getDB(), $sqlquery );
        echo '¡Publicado!';
    } else {
        echo "El nombre no puede quedar vacio";
    }

}



function GetMyMural() {
    $id_me = base64_decode( $_COOKIE[ 'PHP7SESSION' ] );
    echo '<div class="timeline row" data-toggle="isotope">
              <div class="col-xs-12 col-md-6 col-lg-4 item">
                <div class="timeline-block">
                  <div class="panel panel-default share clearfix-xs">
                   <input type="file" name="fileToUpload" id="fileToUpload">
                    <div class="panel-heading panel-heading-gray title">
                      ¿Qué hay de nuevo?
                    </div>
                    <div class="panel-body">
                      <textarea name="status" class="form-control share-text" rows="3" placeholder="Comparte tu estado..." id="post"></textarea>
                    </div>
                    <div class="panel-footer share-buttons">
                      <button type="submit" onClick=post(' . $id_me . ') class="btn btn-primary btn-xs pull-right display-none" href="#">Publicar</button>
<input type=hidden name="defphoto" id="defphoto" value="upload/default.jpg">
<button type="submit" id="upload" class="btn btn-primary btn-xs pull-left display-none" href="#">Subir imagen</button>
                    </div>
                  </div>
                </div>
              </div>';
    $sql = "SELECT profile.name,profile.lastname,profile.photo,post.id_post,post.owner,post.poster,post.post,post.media,post.date,post.poster FROM post INNER JOIN profile ON id_profile=poster WHERE owner='{$id_me}'  ORDER BY id_post desc;";

    $r = mysqli_query( getDB(), $sql );
    while ( $arr = mysqli_fetch_array( $r ) ) {
        $name = $arr[ 'name' ];
        $lastname = $arr[ 'lastname' ];
        $photo = $arr[ 'photo' ];
        $id_post = $arr[ 'id_post' ];
        $owner = $arr[ 'owner' ];
        $poster = $arr[ 'poster' ];
        $post = $arr[ 'post' ];
        $date = $arr[ 'date' ];
        $media = $arr[ 'media' ];
        $sqlcomment = "SELECT id_comment,profile.id_profile,profile.name,profile.lastname,profile.photo,comment.date,comment.comment FROM comment INNER JOIN profile ON profile.id_profile=comment.id_commenter WHERE id_post_com='{$id_post}';";
        //
        if ( strtr( $poster, $id_me ) == 0 ) {
            if ( postedbyme( $id_me, $id_post ) ) {
                echo ' <div class="col-xs-12 col-md-6 col-lg-4 item">
                <div class="timeline-block">
                  <div class="panel panel-default">

                    <div class="panel-heading">
                      <div class="media">
                        <div class="media-left">
                          <a href="">
                            <img src="' . $photo . '" width="50" height="50" class="media-object">
                          </a>
                        </div>
                        <div class="media-body">

                          <a href="">' . $name, " ", $lastname . '</a>
                          
                          <span>el ' . $date . '</span>
                        </div>
                        
                
                      </div>
                    </div>

                    <div class="panel-body">
                      <p>' . $post . '</p>
                      <div class="pull-right dropdown" >
                            <a href="#" data-toggle="dropdown" class="toggle-button">
                              <i class="fa fa-pencil"></i>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                              <li><a href="#" OnClick="editpost(' . $id_post . ')">Editar</a></li>
                              <li><a href="#" OnClick="delpost(' . $id_post . ')">Eliminar</a></li>
                            </ul>
                          </div>';
                if (strcmp($media,"ada")){
                   echo'
                      <img src="'.$media.'" class="img-responsive">'; 
                }
                
                echo'
                    </div>
                    <div class="view-all-comments">
                      <a href="#">
                        <i class="fa fa-comments-o"></i> Comentarios
                      </a>
                    </div>';
            } else {
                echo ' <div class="col-xs-12 col-md-6 col-lg-4 item">
                <div class="timeline-block">
                  <div class="panel panel-default">

                    <div class="panel-heading">
                      <div class="media">
                        <div class="media-left">
                          <a href="">
                            <img src="' . $photo . '" width="50" height="50" class="media-object">
                          </a>
                        </div>
                        <div class="media-body">

                          <a href="">' . $name, " ", $lastname . '</a>
                          
                          <span>el ' . $date . '</span>
                        </div>
                        
                
                      </div>
                    </div>

                    <div class="panel-body">
                      <p>' . $post . '</p>
                      <div class="pull-right dropdown" >
                            <a href="#" data-toggle="dropdown" class="toggle-button">
                              <i class="fa fa-pencil"></i>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                              <li><a href="#" OnClick="delpost(' . $id_post . ')">Eliminar</a></li>
                            </ul>
                          </div>
                      <!--<div class="timeline-added-images">
                        <img src="images/social/100/1.jpg" width="80" alt="photo" />
                        <img src="images/social/100/2.jpg" width="80" alt="photo" />
                        <img src="images/social/100/3.jpg" width="80" alt="photo" />
                      </div>-->
                    </div>
                    <div class="view-all-comments">
                      <a href="#">
                        <i class="fa fa-comments-o"></i> Comentarios
                      </a>
                    </div>';
            }

        } else {
            echo ' <div class="col-xs-12 col-md-6 col-lg-4 item">
                <div class="timeline-block">
                  <div class="panel panel-default">

                    <div class="panel-heading">
                      <div class="media">
                        <div class="media-left">
                          <a href="">
                            <img src="' . $photo . '" width="50" height="50" class="media-object">
                          </a>
                        </div>
                        <div class="media-body">

                          <a href="">' . $name, " ", $lastname . '</a>
                          
                          <span>el ' . $date . '</span>
                        </div>
                        
                
                      </div>
                    </div>

                    <div class="panel-body">
                      <p>' . $post . '</p>
                      <!--<div class="timeline-added-images">
                        <img src="images/social/100/1.jpg" width="80" alt="photo" />
                        <img src="images/social/100/2.jpg" width="80" alt="photo" />
                        <img src="images/social/100/3.jpg" width="80" alt="photo" />
                      </div>-->
                    </div>
                    <div class="view-all-comments">
                      <a href="#">
                        <i class="fa fa-comments-o"></i> Comentarios
                      </a>
                    </div>';
        }

        //
        $r2 = mysqli_query( getDB(), $sqlcomment );
        while ( $ar = mysqli_fetch_array( $r2 ) ) {
            $id_comment = $ar[ 'id_comment' ];
            $id_profc = $ar[ 'id_profile' ];
            $c_name = $ar[ 'name' ];
            $c_lastname = $ar[ 'lastname' ];
            $c_photo = $ar[ 'photo' ];
            $c_date = $ar[ 'date' ];
            $comment = $ar[ 'comment' ];
            if ( commentedbyme( $id_me, $id_comment ) ) {
                echo '<ul class="comments">
                      <li class="media">
                        <div class="media-left">
                          <a href="">
                            <img src="' . $c_photo . '" width="40" height="40" class="media-object">
                          </a>
                        </div>
                        <div class="media-body">
                          <div class="pull-right dropdown" data-show-hover="li">
                            <a href="#" data-toggle="dropdown" class="toggle-button">
                              <i class="fa fa-pencil"></i>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                              <li><a href="#" OnClick="editcomment(' . $id_comment . ')">Editar</a></li>
                              <li><a href="#" OnClick="deletecomment(' . $id_comment . ')">Eliminar</a></li>
                            </ul>
                          </div>
                          <a href="" class="comment-author pull-left">' . $c_name, " ", $c_lastname . '</a>
                          <span>' . $comment . '</span>
                          <div class="comment-date">' . $c_date . '</div>
                        </div>
                      </li>';
            } else {
                echo '<ul class="comments">
                      <li class="media">
                        <div class="media-left">
                          <a href="">
                            <img src="' . $c_photo . '" width="40" height="40" class="media-object">
                          </a>
                        </div>
                        <div class="media-body">
       
                          <a href="" class="comment-author pull-left">' . $c_name, " ", $c_lastname . '</a>
                          <span>' . $comment . '</span>
                          <div class="comment-date">' . $c_date . '</div>
                        </div>
                      </li>';
            }


        }
        echo '<li class="comment-form">
                        <div class="input-group">

                          <input type="text" class="form-control" id="post' . $id_post . '">

                          <span class="input-group-btn">
                   <a href="#" OnClick="postcomment(' . $id_post . ')" class="btn btn-default"><i class="fa fa-comment"></i></a>
                </span>

                        </div>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>';
    }
}

function GetMural( $id_profile_friend ) {
    $id_me = base64_decode( $_COOKIE[ 'PHP7SESSION' ] );
    $id_mural = $id_profile_friend;
    echo '<div class="timeline row" data-toggle="isotope">
              <div class="col-xs-12 col-md-6 col-lg-4 item">
                <div class="timeline-block">
                  <div class="panel panel-default share clearfix-xs">
                    <div class="panel-heading panel-heading-gray title">
                      Publica en el muro de tu amigo:
                    </div>
                    <div class="panel-body">
                      <textarea name="status" class="form-control share-text" rows="3" placeholder="Comparte algo..." id="post"></textarea>
                    </div>
                    <div class="panel-footer share-buttons">
                      <button type="submit" onClick=publishfriendprofile(' . $id_mural . ') class="btn btn-primary btn-xs pull-right display-none" href="#">Publicar</button>
                    </div>
                  </div>
                </div>
              </div></div>';
    $sql = "SELECT profile.name,profile.lastname,profile.photo,post.id_post,post.owner,post.poster,post.post,post.media,post.date,post.poster FROM post INNER JOIN profile ON id_profile=poster WHERE owner='{$id_mural}'  ORDER BY id_post desc;";

    $r = mysqli_query( getDB(), $sql );
    while ( $arr = mysqli_fetch_array( $r ) ) {
        $name = $arr[ 'name' ];
        $lastname = $arr[ 'lastname' ];
        $photo = $arr[ 'photo' ];
        $id_post = $arr[ 'id_post' ];
        $owner = $arr[ 'owner' ];
        $poster = $arr[ 'poster' ];
        $post = $arr[ 'post' ];
        $date = $arr[ 'date' ];
        $media = $arr[ 'media' ];
        $sqlcomment = "SELECT id_comment,profile.id_profile,profile.name,profile.lastname,profile.photo,comment.date,comment.comment FROM comment INNER JOIN profile ON profile.id_profile=comment.id_commenter WHERE id_post_com='{$id_post}';";
        //
        if ( strtr( $poster, $id_me ) == 0 ) {
            $ds = strtr( $poster, $id_me );
            if ( postedbyme( $id_me, $id_post ) ) {
                echo ' <div class="col-xs-12 col-md-6 col-lg-4 item">
                <div class="timeline-block">
                  <div class="panel panel-default">

                    <div class="panel-heading">
                      <div class="media">
                        <div class="media-left">
                          <a href="">
                            <img src="' . $photo . '" width="50" height="50" class="media-object">
                          </a>
                        </div>
                        <div class="media-body">

                          <a href="">' . $name, " ", $lastname . '</a>
                          
                          <span>el ' . $date . '</span>
                        </div>
                        
                
                      </div>
                    </div>

                    <div class="panel-body">
                      <p>' . $post . '</p>
                      <div class="pull-right dropdown" >
                            <a href="#" data-toggle="dropdown" class="toggle-button">
                              <i class="fa fa-pencil"></i>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                              <li><a href="#" OnClick="editpost(' . $id_post . ')">Editar</a></li>
                              <li><a href="#" OnClick="delpost(' . $id_post . ')">Eliminar</a></li>
                            </ul>
                          </div>
                      <!--<div class="timeline-added-images">
                        <img src="images/social/100/1.jpg" width="80" alt="photo" />
                        <img src="images/social/100/2.jpg" width="80" alt="photo" />
                        <img src="images/social/100/3.jpg" width="80" alt="photo" />
                      </div>-->
                    </div>
                    <div class="view-all-comments">
                      <a href="#">
                        <i class="fa fa-comments-o"></i> Comentarios
                      </a>
                    </div>';
            } else {
                echo ' <div class="col-xs-12 col-md-6 col-lg-4 item">
                <div class="timeline-block">
                  <div class="panel panel-default">

                    <div class="panel-heading">
                      <div class="media">
                        <div class="media-left">
                          <a href="">
                            <img src="' . $photo . '" width="50" height="50" class="media-object">
                          </a>
                        </div>
                        <div class="media-body">

                          <a href="">' . $name, " ", $lastname . '</a>
                          
                          <span>el ' . $date . '</span>
                        </div>
                        
                
                      </div>
                    </div>

                    <div class="panel-body">
                      <p>' . $post . '</p>

                      <!--<div class="timeline-added-images">
                        <img src="images/social/100/1.jpg" width="80" alt="photo" />
                        <img src="images/social/100/2.jpg" width="80" alt="photo" />
                        <img src="images/social/100/3.jpg" width="80" alt="photo" />
                      </div>-->
                    </div>
                    <div class="view-all-comments">
                      <a href="#">
                        <i class="fa fa-comments-o"></i> Comentarios
                      </a>
                    </div>';
            }

        } else {
            echo ' <div class="col-xs-12 col-md-6 col-lg-4 item">
                <div class="timeline-block">
                  <div class="panel panel-default">

                    <div class="panel-heading">
                      <div class="media">
                        <div class="media-left">
                          <a href="">
                            <img src="' . $photo . '" width="50" height="50" class="media-object">
                          </a>
                        </div>
                        <div class="media-body">

                          <a href="">' . $name, " ", $lastname . '</a>
                          
                          <span>el ' . $date . '</span>
                        </div>
                        
                
                      </div>
                    </div>

                    <div class="panel-body">
                      <p>' . $post . '</p>
                      <!--<div class="timeline-added-images">
                        <img src="images/social/100/1.jpg" width="80" alt="photo" />
                        <img src="images/social/100/2.jpg" width="80" alt="photo" />
                        <img src="images/social/100/3.jpg" width="80" alt="photo" />
                      </div>-->
                    </div>
                    <div class="view-all-comments">
                      <a href="#">
                        <i class="fa fa-comments-o"></i> Comentarios
                      </a>
                    </div>';
        }

        //
        $r2 = mysqli_query( getDB(), $sqlcomment );
        while ( $ar = mysqli_fetch_array( $r2 ) ) {
            $id_comment = $ar[ 'id_comment' ];
            $id_profc = $ar[ 'id_profile' ];
            $c_name = $ar[ 'name' ];
            $c_lastname = $ar[ 'lastname' ];
            $c_photo = $ar[ 'photo' ];
            $c_date = $ar[ 'date' ];
            $comment = $ar[ 'comment' ];
            echo '<ul class="comments">
                      <li class="media">
                        <div class="media-left">
                          <a href="">
                            <img src="' . $c_photo . '" width="40" height="40" class="media-object">
                          </a>
                        </div>
                        <div class="media-body">
                          <div class="pull-right dropdown" data-show-hover="li">
                            <a href="#" data-toggle="dropdown" class="toggle-button">
                              <i class="fa fa-pencil"></i>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                              <li><a href="#" OnClick="editcomment(' . $id_comment . ')">Editar</a></li>
                              <li><a href="#" OnClick="deletecomment(' . $id_comment . ')">Eliminar</a></li>
                            </ul>
                          </div>
                          <a href="" class="comment-author pull-left">' . $c_name, " ", $c_lastname . '</a>
                          <span>' . $comment . '</span>
                          <div class="comment-date">' . $c_date . '</div>
                        </div>
                      </li>';

        }
        echo '<li class="comment-form">
                        <div class="input-group">

                          <input type="text" class="form-control" id="post' . $id_post . '">

                          <span class="input-group-btn">
                   <a href="#" OnClick="postcomment(' . $id_post . ')" class="btn btn-default"><i class="fa fa-comment"></i></a>
                </span>

                        </div>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>';
    }
}
?>
