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


# # Cargamos el dataset de entrenamiento
X_train = np.array([[
        36, 68, 98, 78, 45, 22, 40, 18, 12, 16, 11, 25, 24, 55, 20,
        28, 25, 60, 27, 29, 40, 55, 80, 60, 48, 22, 42, 19, 14, 18,
        10, 24, 23, 52, 19, 30, 23, 58, 26, 28, 33, 48, 70, 55, 39,
        18, 35, 12, 9, 12, 4, 17, 16, 30, 11, 18, 15, 25, 13, 17, 15,
        25, 35, 30, 20, 8, 15, 5, 3, 6, 1, 5, 5, 15, 5, 8, 5, 15, 8, 10
    ],
    [
        73, 97, 142, 111, 82, 47, 75, 41, 31, 32, 21, 47, 48,
        94, 41, 53, 50, 103, 54, 59, 73, 97, 142, 111, 82, 47,
        75, 41, 31, 32, 21, 47, 48, 94, 41, 53, 50, 103, 54, 59,
        73, 97, 142, 111, 82, 47, 75, 41, 31, 32, 21, 47, 48, 94,
        41, 53, 50, 103, 54, 59, 73, 97, 142, 111, 82, 47, 75,
        41, 31, 32, 21, 47, 48, 94, 41, 53, 50, 103, 54, 59
    ],
    [
        49.32, 70.10, 69.01, 70.27, 54.88, 46.81, 53.33,
        43.90, 38.71, 50.00, 52.38, 53.19, 50.00, 58.51, 48.78, 52.83,
        50.00, 58.25, 50.00, 49.15, 54.79, 56.70, 56.34, 54.05, 58.54,
        46.81, 56.00, 46.34, 45.16, 56.25, 47.62, 51.06, 47.92, 55.32,
        46.34, 56.60, 46.00, 56.31, 48.15, 47.46, 45.21, 49.48, 49.30,
        49.55, 47.56, 38.30, 46.67, 29.27, 29.03, 37.50, 19.05, 36.17,
        33.33, 31.91, 26.83, 33.96, 30.00, 24.27, 24.07, 28.81, 20.55,
        25.77, 24.65, 27.03, 24.39, 17.02, 20.00, 12.20, 9.68, 18.75,
        4.76, 10.64, 10.42, 15.96, 12.20, 15.09, 10.00, 14.56, 14.81, 16.95
    ]])
Y_train = np.array([

])

# # Creamos y entrenamos el modelo de Naive Bayes
# model = GaussianNB()
# model.fit(X_train, Y_train)

# # Realizamos la predicción de la clase del usuario

# usuario = [[aciertos, palabras_totales, score]]
# prediccion = model.predict(usuario)

# print(prediccion)
