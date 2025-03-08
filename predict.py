# import os
# import tensorflow as tf
# import numpy as np
# from tensorflow.keras.preprocessing import image

# # Load trained model
# model_path = r"C:\xampp\htdocs\shreyaPHP\fruit seller\fruit_freshness_model.h5"
# if not os.path.exists(model_path):
#     print(f"❌ Model not found at {model_path}. Train the model first!")
#     exit()

# model = tf.keras.models.load_model(model_path)

# def predict_freshness(image_path):
#     if not os.path.exists(image_path):
#         print(f"❌ Error: Image not found at {image_path}")
#         return

#     # Load and preprocess image
#     img = image.load_img(image_path, target_size=(100, 100))
#     img_array = image.img_to_array(img) / 255.0
#     img_array = np.expand_dims(img_array, axis=0)

#     # Predict
#     prediction = model.predict(img_array)
    
#     if prediction[0][0] > 0.5:
#         print(f"🍏 Fresh fruit! (Confidence: {prediction[0][0]:.2f})")
#     else:
#         print(f"🍎 Not fresh. (Confidence: {1 - prediction[0][0]:.2f})")

# # Test the model
# # test_image = r"C:\xampp\htdocs\shreyaPHP\fruit seller\test_image.jpg"
# # predict_freshness(test_image)

# # Example usage
# # image_path = r"C:\xampp\htdocs\shreyaPHP\fruit seller\dataset\fresh\Anjeer.jpeg"
# # predict_freshness(image_path)

# test_image = r"C:\xampp\htdocs\shreyaPHP\fruit seller\product_image\"
# predict_freshness(test_image)
import os
import tensorflow as tf
import numpy as np
from tensorflow.keras.preprocessing import image

# Load the trained model
model_path = r"C:\xampp\htdocs\shreyaPHP\fruit seller\fruit_freshness_model.h5"
model = tf.keras.models.load_model(model_path)

def predict_freshness(image_path):
    if not os.path.exists(image_path):
        print(f"❌ Error: Image not found at {image_path}")
        return

    img = image.load_img(image_path, target_size=(128, 128))  # ✅ Fix image size to match training
    img_array = image.img_to_array(img) / 255.0
    img_array = np.expand_dims(img_array, axis=0)

    prediction = model.predict(img_array)

    if prediction[0][0] > 0.5:
        print(f"❌ Not Fresh: {os.path.basename(image_path)} (Confidence: {1 - prediction[0][0]:.2f})")
        
    else:
        print(f"✅ Fresh: {os.path.basename(image_path)} (Confidence: {prediction[0][0]:.2f})")

def predict_multiple_images(folder_path):
    if not os.path.exists(folder_path):
        print(f"❌ Error: Folder not found at {folder_path}")
        return

    image_files = [f for f in os.listdir(folder_path) if f.lower().endswith(('.png', '.jpg', '.jpeg'))]

    if not image_files:
        print("❌ No image files found in the folder.")
        return

    print(f"\n🔍 Checking {len(image_files)} images in '{folder_path}'...\n")

    for img_file in image_files:
        img_path = os.path.join(folder_path, img_file)
        print(f"🔄 Processing: {img_path}")  # Debugging print
        predict_freshness(img_path)

# Example usage: Predict all images in the 'product_image' folder
image_folder = r"C:\xampp\htdocs\shreyaPHP\fruit seller\product_image"
predict_multiple_images(image_folder)
