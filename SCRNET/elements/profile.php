<?php
    
include_once('elements/conf.php');


function GetInfoProfile(){
    $p = GetProfileData();
    echo '<div class="row">
              <div class="col-md-6">
                <div class="panel panel-default">
                  <div class="panel-heading panel-heading-gray">
                    <a href="edit-profile.php" class="btn btn-white btn-xs pull-right"><i class="fa fa-pencil"></i></a>
                    <i class="fa fa-fw fa-info-circle"></i> Información
                  </div>
                  <div class="panel-body">
                    <ul class="list-unstyled profile-about margin-none">
                      <li class="padding-v-5">
                        <div class="row">
                          <div class="col-sm-4"><span class="text-muted">Nombre</span></div>
                          <div class="col-sm-8">'.$p ->name.'</div>
                        </div>
                      </li>
                      <li class="padding-v-5">
                        <div class="row">
                          <div class="col-sm-4"><span class="text-muted">Apellidos</span></div>
                          <div class="col-sm-8">'.$p->lastname.'</div>
                        </div>
                      </li>
                      <li class="padding-v-5">
                        <div class="row">
                          <div class="col-sm-4"><span class="text-muted">Genero</span></div>
                          <div class="col-sm-8">'.$p->gender.'</div>
                        </div>
                      </li>
                      <li class="padding-v-5">
                        <div class="row">
                          <div class="col-sm-4"><span class="text-muted">Edad</span></div>
                          <div class="col-sm-8">'.$p->age.'</div>
                        </div>
                      </li>
                      <li class="padding-v-5">
                        <div class="row">
                          <div class="col-sm-4"><span class="text-muted">Fecha de nacimiento</span></div>
                          <div class="col-sm-8">'.$p->birthdate.'</div>
                        </div>
                      </li>
                      <li class="padding-v-5">
                        <div class="row">
                          <div class="col-sm-4"><span class="text-muted">Correo electronico</span></div>
                          <div class="col-sm-8">'.$p->email.'</div>
                        </div>
                      </li>
                      <li class="padding-v-5">
                        <div class="row">
                          <div class="col-sm-4"><span class="text-muted">Credits</span></div>
                          <div class="col-sm-8">249</div>
                        </div>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="panel panel-default">
                  <div class="panel-heading panel-heading-gray">
                    <div class="pull-right">
                      <a href="friends.php?search=true" class="btn btn-primary btn-xs">Añadir <i class="fa fa-plus"></i></a>
                    </div>
                    <i class="icon-user-1"></i> Amigos
                  </div>
                  <div class="panel-body">
                    <ul class="img-grid">';
                    $me = base64_decode($_COOKIE['PHP7SESSION']);
                    $sql = "SELECT profile.photo,id_profile FROM friendship INNER JOIN profile ON id_profile=id_friend1 OR id_profile=id_friend2 WHERE id_friend1='{$me}' OR id_friend2='{$me}';";
                    $r = mysqli_query(getDB(),$sql);
                    while($arr=mysqli_fetch_array($r)){
                        $id_fprof = $arr['id_profile'];
                        $photof = $arr['photo'];
                        if(strcmp($me,$arr['id_profile'])!=0){
                            echo '<li>
                        <a href="profile.php?id='.$id_fprof.'">
                          <img src='.$photof.' alt="image" height="120" width="120"/>
                        </a>
                      </li>';
                        }
                    }echo'
                      
                    </ul>
                  </div>
                </div>
              </div>
            </div>';
}
function GetInfoProfileEdit(){
    $p = GetProfileData();
    echo '<div class="row">
              <div class="col-md-6">
                <div class="panel panel-default">
                  <div class="panel-heading panel-heading-gray">
                    <i class="fa fa-fw fa-info-circle"></i> Información
                  </div>
                  <div class="panel-body">
                    <ul class="list-unstyled profile-about margin-none">
                      <li class="padding-v-5">
                        <div class="row">
                          <div class="col-sm-4"><span class="text-muted">Nombre(s)</span></div>
                          <div class="col-sm-8"><input type="email" class="form-control" id="name" placeholder="Nombre(s).." value="'.$p->name.'"></div>
                        </div>
                      </li>
                      <li class="padding-v-5">
                        <div class="row">
                          <div class="col-sm-4"><span class="text-muted">Apellidos</span></div>
                          <div class="col-sm-8"><input type="email" class="form-control" id="lastname" placeholder="Apellidos.." value="'.$p->lastname.'"></div>
                        </div>
                      </li>
                      <li class="padding-v-5">
                        <div class="row">
                          <div class="col-sm-4"><span class="text-muted">Genero</span></div>
                          <div class="col-sm-8"><select class="selectpicker" data-style="btn-white" data-live-search="false" data-size="5" id="gender">';
    switch($p->gender){
        case "Hombre":
            echo "<option selected>Hombre</option>
                                        <option>Mujer</option>
                                        <option>Indefinido</option>
                                    </select></div>";
            break;
        case "Mujer":
            echo "<option>Hombre</option>
                                        <option selected>Mujer</option>
                                        <option>Indefinido</option>
                                    </select></div>";
            break;
        case "Indefinido":
            echo "<option>Hombre</option>
                                        <option>Mujer</option>
                                        <option selected>Indefinido</option>
                                    </select></div>";
            break;
    }
                                        
                        echo'</div>
                      </li>
                      <li class="padding-v-5">
                        <div class="row">
                          <div class="col-sm-4"><span class="text-muted">Edad</span></div>
                          <div class="col-sm-8"><input type="email" class="form-control" id="age" placeholder="Apellidos.." value="'.$p->age.'"></div>
                        </div>
                      </li>
                      <li class="padding-v-5">
                        <div class="row">
                          <div class="col-sm-4"><span class="text-muted">Fecha de nacimiento</span></div>
                          <div class="col-sm-8"><input id="datepicker" type="text" class="form-control datepicker" value="'.$p->birthdate.'">
                        </div>
                      </li>
                      <li class="padding-v-5">
                        <div class="row">
                          <div class="col-sm-4"><span class="text-muted">Correo electronico</span></div>
                          <div class="col-sm-8"><input type="email" class="form-control" id="email" placeholder="Email.." value="'.$p->email.'"></div>
                        </div>
                      </li>
                      <li class="padding-v-5">
                        <div class="row">
                          <div class="col-sm-4"><span class="text-muted">Biografia</span></div>
                          <div class="col-sm-8"><input type="text" class="form-control" id="bio" placeholder="Biografia.." value="'.$p->biography.'"></div>
                        </div>
                      </li>
                      <li class="padding-v-5">
                        <div class="row">
                          <div class="col-sm-4"><span class="text-muted">Contraseña</span></div>
                          <div class="col-sm-8"><input type="text" class="form-control" id="pass" placeholder="Contraseña.." value="'.$p->password.'"></div>
                        </div>
                      </li>
                      <li class="padding-v-5">
                        <div class="row">
                          <div class="col-sm-4"><span class="text-muted">Telefono</span></div>
                          <div class="col-sm-8"><input type="text" class="form-control" id="phone" placeholder="Telefono.." value="'.$p->phone.'"></div>
                        </div>
                      </li>
                      <li class="padding-v-5">
                        <div class="row">
                        <input type=hidden name="defphoto" id="defphoto" value="'.$p->photo.'">
                          <div class="col-sm-4"><span class="text-muted">Foto</span></div>
                          <div class="col-sm-8">'.$p->photo.'</div>
                        </div>
                      </li>
                      <li class="padding-v-5">
                        <div class="row">
                          <div class="col-sm-4"><span class="text-muted">Nueva foto</span></div>
                          <div class="col-sm-8"><input type="file" name="fileToUpload" id="fileToUpload"></div>
                        </div>
                        <li class="padding-v-5">
                        <div class="row">
                          <div class="col-sm-4"><span class="text-muted"></span></div>
                          <div class="col-sm-8"><a id="upload" name="upload" type="submit" class="btn btn-default btn-md">Editar Perfil  <i class="fa fa-save"></i></a></div>
                        </div>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>';
}
function GetPublicInfoProfile($id_data){
    $p = GetPublicProfile($id_data);
    echo '<div class="row">
              <div class="col-md-6">
                <div class="panel panel-default">
                  <div class="panel-heading panel-heading-gray">
                    <i class="fa fa-fw fa-info-circle"></i> Información
                  </div>
                  <div class="panel-body">
                    <ul class="list-unstyled profile-about margin-none">
                      <li class="padding-v-5">
                        <div class="row">
                          <div class="col-sm-4"><span class="text-muted">Nombre</span></div>
                          <div class="col-sm-8">'.$p ->name.'</div>
                        </div>
                      </li>
                      <li class="padding-v-5">
                        <div class="row">
                          <div class="col-sm-4"><span class="text-muted">Apellidos</span></div>
                          <div class="col-sm-8">'.$p->lastname.'</div>
                        </div>
                      </li>
                      <li class="padding-v-5">
                        <div class="row">
                          <div class="col-sm-4"><span class="text-muted">Genero</span></div>
                          <div class="col-sm-8">'.$p->gender.'</div>
                        </div>
                      </li>
                      <li class="padding-v-5">
                        <div class="row">
                          <div class="col-sm-4"><span class="text-muted">Edad</span></div>
                          <div class="col-sm-8">'.$p->age.'</div>
                        </div>
                      </li>
                      <li class="padding-v-5">
                        <div class="row">
                          <div class="col-sm-4"><span class="text-muted">Fecha de nacimiento</span></div>
                          <div class="col-sm-8">'.$p->birthdate.'</div>
                        </div>
                      </li>
                      <li class="padding-v-5">
                        <div class="row">
                          <div class="col-sm-4"><span class="text-muted">Correo electronico</span></div>
                          <div class="col-sm-8">'.$p->email.'</div>
                        </div>
                      </li>
                      <li class="padding-v-5">
                        <div class="row">
                          <div class="col-sm-4"><span class="text-muted">Credits</span></div>
                          <div class="col-sm-8">249</div>
                        </div>
                      </li>
                    </ul>
                  </div>
                </div>
              </div>
              <div class="col-md-6">
                <div class="panel panel-default">
                  <div class="panel-heading panel-heading-gray">
                    <div class="pull-right">
                      <a href="friends.php?search=true" class="btn btn-primary btn-xs">Añadir <i class="fa fa-plus"></i></a>
                    </div>
                    <i class="icon-user-1"></i> Amigos
                  </div>
                  <div class="panel-body">
                    <ul class="img-grid">';
                    $me = base64_decode($_COOKIE['PHP7SESSION']);
                    $sql = "SELECT profile.photo,id_profile FROM friendship INNER JOIN profile ON id_profile=id_friend1 OR id_profile=id_friend2 WHERE id_friend1='{$me}' OR id_friend2='{$me}';";
                    $r = mysqli_query(getDB(),$sql);
                    while($arr=mysqli_fetch_array($r)){
                        $id_fprof = $arr['id_profile'];
                        $photof = $arr['photo'];
                        if(strcmp($me,$arr['id_profile'])!=0){
                            echo '<li>
                        <a href="profile.php?id='.$id_fprof.'">
                          <img src='.$photof.' alt="image" />
                        </a>
                      </li>';
                        }
                    }echo'
                      
                    </ul>
                  </div>
                </div>
              </div>
            </div>';
}
function itsMyFriend($id_profile){
    $me = base64_decode($_COOKIE['PHP7SESSION']);
    $sqlquery = "SELECT * FROM friendship WHERE id_friend1={$id_profile} AND id_friend2={$me} OR id_friend1={$me} AND id_friend2={$id_profile}";
        $r = mysqli_query(getDB(),$sqlquery);
        while($arr=mysqli_fetch_array($r)){ 
            return true;
        }
    return false;
}
function GetPublicProfile($id_prof){
    //$id_profile = base64_decode($_COOKIE['PHP7SESSION']);
        $sqlquery = "SELECT * FROM profile WHERE id_profile='{$id_prof}'";
        $r = mysqli_query(getDB(),$sqlquery);
        $profile = new stdClass();
        while($arr=mysqli_fetch_array($r)){ 
            $profile -> id = $arr['id_profile'];
            $profile -> name = $arr['name'];
            $profile -> lastname = $arr['lastname'];
            $profile -> age = $arr['age'];
            $profile -> gender = $arr['gender'];
            $profile -> birthdate = $arr['birthdate'];
            $profile -> photo = $arr['photo'];
            $profile -> biography = $arr['biography'];
            $profile -> email = $arr['email'];
            $profile -> password = $arr['password'];
            $profile -> phone = $arr['phone'];
        }
    return $profile;
}

function GetProfileData(){
    if(isset($_COOKIE['PHP7SESSION'])){     
        $id_profile = base64_decode($_COOKIE['PHP7SESSION']);
        $sqlquery = "SELECT * FROM profile WHERE id_profile='{$id_profile}'";
        $r = mysqli_query(getDB(),$sqlquery);
        $profile = new stdClass();
        while($arr=mysqli_fetch_array($r)){ 
            $profile -> id = $arr['id_profile'];
            $profile -> name = $arr['name'];
            $profile -> lastname = $arr['lastname'];
            $profile -> age = $arr['age'];
            $profile -> gender = $arr['gender'];
            $profile -> birthdate = $arr['birthdate'];
            $profile -> photo = $arr['photo'];
            $profile -> biography = $arr['biography'];
            $profile -> email = $arr['email'];
            $profile -> password = $arr['password'];
            $profile -> phone = $arr['phone'];
        }
        
    }
    return $profile;
}

?>