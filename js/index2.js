// firebase.js

import { initializeApp } from "https://www.gstatic.com/firebasejs/9.6.1/firebase-app.js";
import { getAuth, createUserWithEmailAndPassword } from "https://www.gstatic.com/firebasejs/9.6.1/firebase-auth.js";
import { getFirestore, setDoc, doc } from "https://www.gstatic.com/firebasejs/9.6.1/firebase-firestore.js";

// Configuración de Firebase
const firebaseConfig = {
    apiKey: "AIzaSyBhDsiKAiCJjaLNemZFJw9R0HDC5OMNvmE",
    authDomain: "dream-event-290b1.firebaseapp.com",
    projectId: "dream-event-290b1",
    storageBucket: "dream-event-290b1.firebasestorage.app",
    messagingSenderId: "25099640705",
    appId: "1:25099640705:web:aa407110982ffa0809d280"
};

// Inicializar Firebase
const app = initializeApp(firebaseConfig);
const auth = getAuth();
const db = getFirestore();

// Llamar a la función cuando el usuario inicie sesión correctamente
registerUser("Dream_event@gmail.com");

import { getAuth, signInWithEmailAndPassword } from "https://www.gstatic.com/firebasejs/9.6.1/firebase-auth.js";

// Configurar Firebase
const auth = getAuth();

// Función para iniciar sesión
async function loginUser(email, password) {
    try {
        const userCredential = await signInWithEmailAndPassword(auth, email, password);
        const user = userCredential.user;
        console.log("Inicio de sesión exitoso:", user);
        alert("Bienvenido " + user.email);
    } catch (error) {
        console.error("Error en el login:", error.message);
        alert("Credenciales incorrectas.");
    }
}

// Llamar a la función con las credenciales del usuario
loginUser("Dream_event@gmail.com", "Dreamevent1234");
