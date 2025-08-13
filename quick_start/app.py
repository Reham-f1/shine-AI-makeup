import os
from PIL import Image
from io import BytesIO
import numpy as np
from flask import Flask, request, jsonify, send_file
import requests
import CSD_MT_eval
from flask_cors import CORS

app = Flask(__name__)
CORS(app)

# Global variable to store the processed image
processed_image_path = "processed_image.png"


# دالة لتحميل الصورة من مجلد Mstyles
def load_image_from_folder(image_name):
    folder_path = os.path.join(os.getcwd(), 'Mstyles')
    file_path = os.path.join(folder_path, image_name)
    if os.path.exists(file_path):
        print(f"[INFO] تم العثور على صورة المكياج: {image_name}")
        return Image.open(file_path)
    else:
        raise Exception(f"[ERROR] فشل العثور على الصورة: {image_name} في المجلد Mstyles")

# Function to process images using the model
def get_makeup_transfer_results256(non_makeup_img, makeup_img):
    try:
        non_makeup_array = np.array(non_makeup_img)
        makeup_array = np.array(makeup_img)
        print("[INFO] Starting image processing using the model...")
        transfer_img = CSD_MT_eval.makeup_transfer256(non_makeup_array, makeup_array)
        print("[INFO] Image processing completed!")
        return Image.fromarray(transfer_img)
    except Exception as e:
        print(f"[ERROR] Error during image processing: {e}")
        return None

@app.route('/process_image', methods=['POST'])
def process_image():
    try:
        print("[INFO] Received a new request for image processing.")

        # Retrieve data from the request
        image_url = request.form.get('imageUrl')
        user_upload = request.files.get('faceUpload')
        selected_face_shape = request.form.get('selectedFaceShapeText')

        if not image_url:
            print("[ERROR] imageUrl not provided.")
            return jsonify({'error': 'imageUrl is missing'}), 400
        if not user_upload and not selected_face_shape:
            print("[ERROR] Neither faceUpload nor selectedFaceShapeText provided.")
            return jsonify({'error': 'Please provide either faceUpload or selectedFaceShapeText'}), 400

        print(f"[INFO] Data received successfully: imageUrl = {image_url}, faceUpload = {user_upload}, selectedFaceShapeText = {selected_face_shape}")

        # Load the makeup image (imageUrl should be a path or URL)
        makeup_img = load_image_from_folder(image_url)

        # Load the face image based on either face upload or selected face shape
        try:
            if user_upload:
                # Process uploaded face image
                non_makeup_img = Image.open(BytesIO(user_upload.read()))
                print(f"[INFO] Face image loaded from faceUpload: {user_upload.filename}")
            elif selected_face_shape:
                # Process selected face shape image
                non_makeup_img = load_image_from_folder(selected_face_shape)
                print(f"[INFO] Face image loaded based on selectedFaceShapeText: {selected_face_shape}")
            else:
                print("[ERROR] No face image to load.")
                return jsonify({'error': 'Failed to load face image'}), 400
        except Exception as e:
            print(f"[ERROR] Error while loading face image: {e}")
            return jsonify({'error': 'Failed to load face image'}), 400

        # Process the image
        processed_img = get_makeup_transfer_results256(non_makeup_img, makeup_img)
        if processed_img is None:
            print("[ERROR] Image processing failed.")
            return jsonify({'error': 'Image processing failed'}), 400

        print("[INFO] Image processed successfully!")

        # Save the processed image on the server
        processed_img.save(processed_image_path)

        print("[INFO] Processed image saved.")
        return jsonify({'message': 'Image processed successfully!', 'processedImage': '/get_processed_image'})

    except Exception as e:
        print(f"[ERROR] Error during request processing: {e}")
        return jsonify({'error': str(e)}), 500

# Endpoint to retrieve the processed image
@app.route('/get_processed_image', methods=['GET'])
def get_processed_image():
    try:
        if os.path.exists(processed_image_path):
            print("[INFO] Retrieving the processed image...")
            return send_file(processed_image_path, mimetype='image/png')
        else:
            print("[ERROR] Processed image not found.")
            return jsonify({'error': 'Processed image not found'}), 404
    except Exception as e:
        print(f"[ERROR] Error while retrieving the processed image: {e}")
        return jsonify({'error': str(e)}), 500

if __name__ == '__main__':
    app.run(port=5000)
