# AI Based Makeup Recommendation and Application for Women
## 📌 Overview
An innovative and privacy-respecting project built specifically for female users. The system recommends and virtually applies makeup based on the user's clothing color, skin tone, and makeup style preference. To protect user privacy, it allows users to either upload a real face image or choose from preset face shapes.

---

## ✨ Features

- Detects clothing color from uploaded outfit images.
- Accepts skin tone and makeup style preference (Natural or Bold).
- Generates personalized makeup look using AI.
- Applies makeup virtually using open-source models.
- Offers privacy by allowing face presets instead of real photos.
- Stores feedback securely in a local MySQL database.
- Fully local setup — no data is shared externally.

---

## 🧠 System Workflow

1. **Upload Outfit Image**  
   A custom-trained ML model (TensorFlow + PyTorch) analyzes the photo and detects the main clothing color.

2. **Input Preferences**  
   Users select:
   - Skin tone: Fair, Medium, or Dark
   - Makeup style: Natural or Bold

3. **Makeup Generation**  
   A custom function combines color, tone, and style to produce a reference makeup image.

4. **Makeup Application**  
   An open-source model merges the reference makeup onto a real or preset face image.

5. **Rating and Feedback**  
   Users rate the result. Ratings are stored locally in a MySQL database for future improvements.

---

## 🎯 AI Models used 

1. **Custom Outfit Color Extraction Model**

2. **Makeup Transfer Model (CSD-MT)**

   Based on the Content-Style Decoupled Makeup Transfer algorithm.  
   **Source**: [CSD-MT GitHub Repository](https://github.com/Snowfallingplum/CSD-MT/tree/main/quick_start)

3. **AMCT (Analyze Makeup Color Template)**

   Custom internal algorithm that combines clothing color + skin tone + makeup type to select the best template.


## ⚙️ Local Setup Instructions

1. **Install Anaconda**  
   Download Anaconda and install it if you don't have it.

2. **Open Anaconda Prompt**  
   Navigate to your project directory:
   ```
   cd path/to/project
   ```

3. **Create Conda Environment**
   ```
   conda env create -f environment.yaml
   ```

4. **Activate Environment**
   ```
   conda activate CSDMT
   ```

5. **Install PyTorch**
   ```
   conda install pytorch torchvision torchaudio -c pytorch
   ```

6. **Verify PyTorch**
   ```
   python -c "import torch; print(torch.__version__)"
   ```

7. **Install Gradio**
   ```
   pip install gradio
   ```

8. **Verify Gradio**
   ```
   python -c "import gradio; print(gradio.__version__)"
   ```

9. **Open VS Code**
    ```
    code .
    ```

10. **Install Flask (Inside VS Code Terminal)**
    ```
    pip install flask
    ```

11. **Navigate to App Folder**
    ```
    cd quick_start
    ```

12. **Run the App**
    ```
    python app.py
    ```

13. **Start XAMPP**
    - Open XAMPP
    - Activate **Apache** and **MySQL**

14. **XAMPP Directory Setup**
    - Place the `shine` folder in:
      ```
      C:\xampp\htdocs\
      ```

15. **Open Shine in Browser**
    - Go to:
      ```
      http://localhost/shine/
      ```

---

## 🧰 Technologies Used

- **Python**
- **TensorFlow**
- **PyTorch**
- **Flask**
- **Gradio**
- **MySQL**
- **XAMPP**
- **VS Code**

---

## 🔒 Privacy First

- No personal data is stored or shared.
- Users can choose preset faces instead of uploading real images.
- All feedback is stored locally and securely.

---

## 🧡 Ideal For

Women who value **privacy** and want **AI-powered smart makeup recommendations** tailored to their outfit, skin tone, and personal style.

---

## Contributors

This project is a collaborative work by:

- **Reham Al-Otaibi**
- **Lana aljuaid**
- **Fatimah Al-Zahrani**
- **Asma Al-Asmari**



