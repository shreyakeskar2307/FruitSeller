import os
import tensorflow as tf
import numpy as np
from tensorflow.keras.preprocessing.image import ImageDataGenerator
from tensorflow.keras.models import Sequential
from tensorflow.keras.layers import Conv2D, MaxPooling2D, Flatten, Dense

# Define dataset path
dataset_path = r"C:\xampp\htdocs\shreyaPHP\fruit seller\dataset"

# Image Preprocessing
datagen = ImageDataGenerator(rescale=1.0 / 255, validation_split=0.2)

train_generator = datagen.flow_from_directory(
    dataset_path,
    target_size=(128, 128),  # ✅ Ensure images are 128x128
    batch_size=32,
    class_mode="binary",
    subset="training",
)

val_generator = datagen.flow_from_directory(
    dataset_path,
    target_size=(128, 128),
    batch_size=32,
    class_mode="binary",
    subset="validation",
)

# Define the Model
model = Sequential(
    [
        Conv2D(32, (3, 3), activation="relu", input_shape=(128, 128, 3)),
        MaxPooling2D(2, 2),
        Conv2D(64, (3, 3), activation="relu"),
        MaxPooling2D(2, 2),
        Flatten(),
        Dense(128, activation="relu"),
        Dense(1, activation="sigmoid"),  # Binary classification (fresh/not fresh)
    ]
)

# Compile Model
model.compile(optimizer="adam", loss="binary_crossentropy", metrics=["accuracy"])

# Train Model
print("🚀 Training model...")
model.fit(train_generator, validation_data=val_generator, epochs=5)

# Save Model
model_path = r"C:\xampp\htdocs\shreyaPHP\fruit seller\fruit_freshness_model.h5"
model.save(model_path)
print(f"✅ Model saved at {model_path}")
