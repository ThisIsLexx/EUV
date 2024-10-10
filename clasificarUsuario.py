import sys
import json
import numpy as np
import pandas as pd
from sklearn.model_selection import train_test_split
from sklearn.naive_bayes import GaussianNB
from sklearn.metrics import accuracy_score, classification_report

# Cargamos el dataset desde laravel para poderlo utilizar en el clasificador

# Verificamos si se proporcionó la ruta del archivo JSON
if len(sys.argv) > 1:
    try:
        # Leer el archivo JSON
        file_path = sys.argv[1]
        with open(file_path, 'r') as f:
            data = json.load(f)
    except json.JSONDecodeError as e:
        print(f"Error: Invalid JSON input - {e}")
    except Exception as e:
        print(f"Unexpected error: {e}")
else:
    print("Error: No input file provided")


aciertos = [
        36, 68, 98, 78, 45, 22, 40, 18, 12, 16, 11, 25, 24, 55, 20,
        28, 25, 60, 27, 29, 40, 55, 80, 60, 48, 22, 42, 19, 14, 18,
        10, 24, 23, 52, 19, 30, 23, 58, 26, 28, 33, 48, 70, 55, 39,
        18, 35, 12, 9, 12, 4, 17, 16, 30, 11, 18, 15, 25, 13, 17, 15,
        25, 35, 30, 20, 8, 15, 5, 3, 6, 1, 5, 5, 15, 5, 8, 5, 15, 8, 10,
        71, 84, 121, 111, 76, 39, 67, 38, 27,
        29, 18, 44, 48, 34, 48, 49, 101, 48,
        45, 71, 97, 136, 109, 82, 44, 72, 19
    ]

total_palabras = [
        73, 97, 142, 111, 82, 47, 75, 41, 31, 32, 21, 47, 48,
        94, 41, 53, 50, 103, 54, 59, 73, 97, 142, 111, 82, 47,
        75, 41, 31, 32, 21, 47, 48, 94, 41, 53, 50, 103, 54, 59,
        73, 97, 142, 111, 82, 47, 75, 41, 31, 32, 21, 47, 48, 94,
        41, 53, 50, 103, 54, 59, 73, 97, 142, 111, 82, 47, 75,
        41, 31, 32, 21, 47, 48, 94, 41, 53, 50, 103, 54, 59,
        73, 97, 142, 111, 82, 47, 75, 41, 31,
        32, 21, 47, 48, 41, 53, 50, 103, 54,
        59, 73, 97, 142, 111, 82, 47, 75, 20
    ]
score = [
        49.32, 70.10, 69.01, 70.27, 54.88, 46.81, 53.33,
        43.90, 38.71, 50.00, 52.38, 53.19, 50.00, 58.51, 48.78, 52.83,
        50.00, 58.25, 50.00, 49.15, 54.79, 56.70, 56.34, 54.05, 58.54,
        46.81, 56.00, 46.34, 45.16, 56.25, 47.62, 51.06, 47.92, 55.32,
        46.34, 56.60, 46.00, 56.31, 48.15, 47.46, 45.21, 49.48, 49.30,
        49.55, 47.56, 38.30, 46.67, 29.27, 29.03, 37.50, 19.05, 36.17,
        33.33, 31.91, 26.83, 33.96, 30.00, 24.27, 24.07, 28.81, 20.55,
        25.77, 24.65, 27.03, 24.39, 17.02, 20.00, 12.20, 9.68, 18.75,
        4.76, 10.64, 10.42, 15.96, 12.20, 15.09, 10.00, 14.56, 14.81, 16.95,
        97.26, 86.59, 85.21, 100, 92.68, 82.97, 89.33, 92.68, 87.09,
       90.62, 85.71, 93.61, 100, 82.92, 90.56, 98, 98.05, 88.88,
       76.27, 97.26, 100, 95.77, 98.19, 100, 93.61, 96, 95
    ]
clasificaciones = [
        "media", "alta", "media", "alta", "media", "media", "media",
        "media", "media", "media", "media", "media", "media", "media", "media", "media",
        "media", "media", "media", "media", "media", "media", "media", "media", "media",
        "media", "media", "media", "media", "media", "media", "media", "media", "media",
        "media", "media", "media", "media", "media", "media", "media", "media", "media",
        "media", "media", "media", "media", "baja", "baja", "baja", "baja", "baja",
        "baja", "baja", "baja", "baja", "baja", "baja", "baja", "baja", "baja", "baja",
        "baja", "baja", "baja", "baja", "baja", "baja", "baja", "baja", "baja", "baja",
        "baja", "baja", "baja", "baja", "baja", "baja", "baja", "baja",
        "alta", "alta", "alta", "alta", "alta", "alta", "alta", "alta", "alta"
        "alta", "alta", "alta", "alta", "alta", "alta" "alta", "alta", "alta",
        "alta", "alta", "alta", "alta", "alta", "alta", "alta", "alta", "alta", "alta", "alta"
    ]

# Cargamos el dataset de entrenamiento
X_train = np.array(list(zip(aciertos, total_palabras, score)))
Y_train = np.array(clasificaciones)

# Creamos y entrenamos el modelo de Naive Bayes
model = GaussianNB()
model.fit(X_train, Y_train)

## Realizamos la predicción de la clase del usuario

aciertos_usuario = data['aciertos']
total_palabras_usuario = data['total_palabras']
score_usuario = data['score']


# Creamos nuestro usuario

usuario = np.array([[aciertos_usuario, total_palabras_usuario, score_usuario]])

# Hacemos la predicción
prediccion = model.predict(usuario)

# Mostramos solo la clase predicha

print(prediccion[0])
