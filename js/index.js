import { getAuth, createUserWithEmailAndPassword, signInWithEmailAndPassword } from "firebase/auth";

// Import the functions you need from the SDKs you need
import { initializeApp } from "firebase/app";
// TODO: Add SDKs for Firebase products that you want to use
// https://firebase.google.com/docs/web/setup#available-libraries

// Your web app's Firebase configuration
const firebaseConfig = {
  apiKey: "AIzaSyBhDsiKAiCJjaLNemZFJw9R0HDC5OMNvmE",
  authDomain: "dream-event-290b1.firebaseapp.com",
  projectId: "dream-event-290b1",
  storageBucket: "dream-event-290b1.firebasestorage.app",
  messagingSenderId: "25099640705",
  appId: "1:25099640705:web:aa407110982ffa0809d280"
};

// Initialize Firebase
const app = initializeApp(firebaseConfig);

async function registerUser(email, password, name) {
  try {
    // Registrar usuario con correo y contraseña en Firebase Authentication
    const userCredential = await createUserWithEmailAndPassword(auth, email, password);
    const user = userCredential.user; // Usuario autenticado

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
function handleRegister() {
  const email = document.getElementById('registerEmail').value;
  const password = document.getElementById('registerPassword').value;
  const name = document.getElementById('registerName').value;
  
  registerUser(email, password, name);
}

async function loginUser(email, password) {
  try {
    // Iniciar sesión con el correo y la contraseña del usuario
    const userCredential = await signInWithEmailAndPassword(auth, email, password);
    const user = userCredential.user;

    console.log('Usuario logueado:', user);
    // Aquí puedes redirigir al usuario a una página protegida o mostrar su perfil.
  } catch (error) {
    console.error('Error al iniciar sesión:', error.message);
  }
}

function handleLogin() {
  const email = document.getElementById('loginEmail').value;
  const password = document.getElementById('loginPassword').value;
  
  loginUser(email, password);
}
async function saveUserPreferences(userId, preferences) {
  try {
    await setDoc(doc(db, "users", userId), {
      preferences: preferences
    }, { merge: true });

    console.log("Preferencias guardadas correctamente");
  } catch (error) {
    console.error("Error al guardar preferencias:", error.message);
  }
}
auth.onAuthStateChanged((user) => {
  if (user) {
    console.log('Usuario autenticado:', user);
    // Aquí puedes redirigir o mostrar contenido de usuario
  } else {
    console.log('Usuario no autenticado');
  }
});
window.location.href = "index.php"; // Redirige a una página
