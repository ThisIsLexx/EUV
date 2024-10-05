import sys
import json
import numpy as np
import pandas as pd
from sklearn.model_selection import train_test_split
from sklearn.naive_bayes import GaussianNB
from sklearn.metrics import accuracy_score, classification_report

# Cargamos el dataset desde laravel para poderlo utilizar en el clasificador
print(sys.argv)

# Verificamos si se proporcionó un argumento de entrada
if len(sys.argv) > 1:
    try:
        input_str = sys.argv[1]
        print(f"Input JSON string: {input_str}")
        data = json.loads(input_str)  # Ahora debería cargar correctamente
        print(data)
    except json.JSONDecodeError as e:
        print(f"Error: Invalid JSON input - {e}")
    except Exception as e:
        print(f"Unexpected error: {e}")
else:
    print("Error: No input data provided")


# # Cargamos el dataset de entrenamiento
# X_train = np.array()
# Y_train = np.array()

# # Creamos y entrenamos el modelo de Naive Bayes
# model = GaussianNB()
# model.fit(X_train, Y_train)

# # Realizamos la predicción de la clase del usuario

# usuario = [[aciertos, palabras_totales, score]]
# prediccion = model.predict(usuario)

# print(prediccion)
