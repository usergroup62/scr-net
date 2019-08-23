<!DOCTYPE html>
<html class="hide-sidebar ls-bottom-footer" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Registrate en porfi</title>

    <link href="css/vendor/all.css" rel="stylesheet">
    <link href="css/app/app.css" rel="stylesheet">

</head>

<body class="login">

    <div id="content">
        <div class="container-fluid">
            <br><br>
            <div class="panel panel-default text-center">
                <h4 class="page-section-heading">Formulario de registro</h4>
                <div class="panel-body">
                    <form action="#">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group form-control-default">
                                    <label for="exampleInputFirstName">Nombre(s)</label>
                                    <input type="text" class="form-control" id="name" placeholder="Nombre(s)">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-control-default">
                                    <label for="exampleInputLastName">Apellidos</label>
                                    <input type="text" class="form-control" id="lastname" placeholder="Apellidos">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group form-control-default">
                                    <label for="exampleInputEmail1">Fecha de nacimiento</label>
                                    <input type="datepicker" class="form-control datepicker" id="birthdate" placeholder="Seleccione su fecha de nacimiento">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group form-control-default">
                                    <label for="exampleInputEmail1">Genero</label>
                                    <select class="selectpicker" data-style="btn-white" data-live-search="false" data-size="5" id="gender">
                                        <option>Hombre</option>
                                        <option>Mujer</option>
                                        <option>Indefinido</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group form-control-default">
                                    <label for="exampleInputLastName">Edad</label>
                                    <input type="text" class="form-control" id="age" placeholder="Edad">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group form-control-default required">
                                    <label for="exampleInputEmail1">Correo electronico</label>
                                    <input type="email" class="form-control" id="email" placeholder="Introduzca su correo electronico">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group form-control-default required">
                                    <label for="exampleInputPassword1">Contraseña</label>
                                    <input type="password" class="form-control" id="password" placeholder="Contraseña">
                                </div>
                            </div>
                        </div>

                </div>
                <button type="submit" class="btn btn-primary" onClick="register()">Submit</button><br>
                <a href="login.php" class="forgot-password">¿Tienes cuenta? Inicia sesión</a>
                </form>
            </div>
        </div>

    </div>

    </div>

    <!-- Footer -->
    <footer class="footer">
        <strong>social.scrapywar.com</strong> v1.0
    </footer>
    <!-- // Footer -->
    <!-- Inline Script for colors and config objects; used by various external scripts; -->
    <script>
        var colors = {
            "danger-color": "#e74c3c",
            "success-color": "#81b53e",
            "warning-color": "#f0ad4e",
            "inverse-color": "#2c3e50",
            "info-color": "#2d7cb5",
            "default-color": "#6e7882",
            "default-light-color": "#cfd9db",
            "purple-color": "#9D8AC7",
            "mustard-color": "#d4d171",
            "lightred-color": "#e15258",
            "body-bg": "#f6f6f6"
        };
        var config = {
            theme: "social-2",
            skins: {
                "default": {
                    "primary-color": "#16ae9f"
                },
                "orange": {
                    "primary-color": "#e74c3c"
                },
                "blue": {
                    "primary-color": "#4687ce"
                },
                "purple": {
                    "primary-color": "#af86b9"
                },
                "brown": {
                    "primary-color": "#c3a961"
                },
                "default-nav-inverse": {
                    "color-block": "#242424"
                }
            }
        };
    </script>

    <script src="js/vendor/all.js"></script>
    <script src="js/app/app.js"></script>
    <script src="js/social/manager.js"></script>


</body>

</html>
