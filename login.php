<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">   
   
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
 
     <!-- Site Metas -->
    <title>DREAM EVENT TEAM</title>  
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Site Icons -->
    <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" href="images/apple-touch-icon.png">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Pogo Slider CSS -->
    <link rel="stylesheet" href="css/pogo-slider.min.css">
	<!-- Site CSS -->
    <link rel="stylesheet" href="css/style.css">    
    <!-- Responsive CSS -->
    <link rel="stylesheet" href="css/responsive.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/custom.css">

    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

</head>
<body>

  <!-- Start Login -->
  <div id="login" class="contact-box">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="title-box">
            <h2>Login</h2>
            <p>Accede a tu cuenta</p>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12 col-sm-12 col-xs-12">
          <div class="contact-block">
            <form method="POST" id="loginForm" action="login.php">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <input type="email" class="form-control" id="email" name="email" placeholder="Correo Electrónico" required data-error="Por favor ingresa tu correo electrónico">
                    <div class="help-block with-errors"></div>
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <input type="password" class="form-control" id="password" name="password" placeholder="Contraseña" required data-error="Por favor ingresa tu contraseña">
                    <div class="help-block with-errors"></div>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="submit-button text-center">
                    <button class="btn btn-common" id="submit" type="submit">Iniciar Sesión</button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
 <!-- Scripts -->
 <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  <script src="https://www.gstatic.com/firebasejs/9.6.1/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/9.6.1/firebase-auth.js"></script>
    <script src="https://www.gstatic.com/firebasejs/9.6.1/firebase-firestore.js"></script>
    <script src="index.js"></script>  <!-- Aquí vinculas tu archivo index.js -->

    <script type="module">
        import { initializeApp } from "firebase/app";
import { getAuth, createUserWithEmailAndPassword } from "firebase/auth";
import { getFirestore, doc, setDoc } from "firebase/firestore";

// Configuración de Firebase
const firebaseConfig = {
  apiKey: "tu-api-key",
  authDomain: "tu-auth-domain",
  projectId: "tu-project-id",
  storageBucket: "tu-storage-bucket",
  messagingSenderId: "tu-sender-id",
  appId: "tu-app-id"
};

// Inicializar Firebase
const app = initializeApp(firebaseConfig);
const auth = getAuth();
const db = getFirestore();

// Función para registrar usuario
async function registerUser(email, password, name) {
  try {
    // Crear usuario con email y contraseña
    const userCredential = await createUserWithEmailAndPassword(auth, email, password);
    const user = userCredential.user;

    // Guardar datos adicionales del usuario en Firestore
    await setDoc(doc(db, "users", user.uid), {
      name: name,
      email: email,
      createdAt: new Date()
    });

    console.log("Usuario registrado y datos guardados en Firestore");
  } catch (error) {
    console.error("Error al registrar:", error.message);
  }
}

// Manejar el registro de usuario
function handleRegister() {
  const email = document.getElementById('registerEmail').value;
  const password = document.getElementById('registerPassword').value;
  const name = document.getElementById('registerName').value;
  
  // Llamar la función para registrar el usuario
  registerUser(email, password, name);
}

    </script>
</body>
</html>