<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trazabilidad Masterdent Ltda.</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" />
</head>

<style>
    body {
        background-color: #17569F;
        font-family: Arial, sans-serif;
        margin: 0;
    }

    .header {
        background-color: #17569F;
        text-align: center;
        padding: 1rem 0;
    }

    .header img {
        width: 100%;
        max-width: 400px;
    }

    .formContainer {
        width: 80%;
        max-width: 400px;
        text-align: center;
        background-color: #fff;
        border: 3px solid #17569F;
        border-radius: 10px;
        padding: 2rem;
        margin: 0 auto;
        margin-top: 2rem;
    }

    .formContainer h1 {
        color: #17569F;
        font-size: 24px;
        margin-bottom: 1.5rem;
    }

    .input-label {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .input-label label {
        font-size: 18px;
        color: #17569F;
    }

    .input-group-text {
        background-color: #17569F;
        color: #FFFFFF;
    }

    .form-control {
        border: 2px solid #17569F;
        border-radius: 5px;
    }

    .btn-primary {
        background-color: #17569F;
        border: none;
        color: #FFFFFF;
        margin-top: 1rem;
    }

    .btn-primary:hover {
        background-color: #0E3A6E;
    }
</style>

<body>
    <div class="header">
        <img src="Public/imagenes/nuevamasterdent.png" class="img-fluid" alt="Trazabilidad">
    </div>
    <main>
        <section class="formContainer">
            <form action="login_masterd/val_usuario.php" method="POST" class="form-group">
                <h1>Trazabilidad Masterdent Ltda.</h1>
                <div class="input-label">
                    <label for="usuario">Usuario</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fa fa-user"></i>
                            </div>
                        </div>
                        <input type="text" class="form-control" placeholder="Usuario" name="usuario">
                    </div>
                </div>
                <div> 
                <div class="input-label pt-3">
                    <label for="contraseña">Contraseña</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <div class="input-group-text">
                                <i class="fa fa-lock"></i>
                            </div>
                        </div>
                        <input type="password" class="form-control" placeholder="Contraseña" name="contraseña">
                    </div>
                </div>

                <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
                <div class="d-flex justify-content-between w-100 align-items-center mt-4">
                    <label for="remember" class="d-flex gap-3">
                        <input type="checkbox" value="remember" id="remember" name="forRemember" class="form-control">
                        <span>Recordarme</span>
                    </label>
                    <a href="login_masterd/recuperar_Contraseña.php" target="_blank" rel="noopener noreferrer" style="color: #17569F;">Olvidé la Contraseña</a>
                </div>
            </form>
        </section>
    </main>
</body>
</html>
