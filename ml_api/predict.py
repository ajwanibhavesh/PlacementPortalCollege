import pickle
import sys
import numpy as np
from datetime import datetime

# Load the trained model and label encoders
with open("rf_model.pkl", "rb") as f:
    model = pickle.load(f)

# Load the label encoders for candidate and interviewer
with open("candidate_label_encoder.pkl", "rb") as f:
    le_cand = pickle.load(f)
    
with open("interviewer_label_encoder.pkl", "rb") as f:
    le_intr = pickle.load(f)

# Function to convert Unix timestamp to human-readable time
def unix_to_human(unix_timestamp):
    return datetime.utcfromtimestamp(unix_timestamp).strftime('%Y-%m-%d %H:%M:%S')

# Function to predict interview time
def predict_interview_time(candidate, interviewer, hour, day):
    # Encode candidate and interviewer names
    candidate_encoded = le_cand.transform([candidate])[0]
    interviewer_encoded = le_intr.transform([interviewer])[0]

    # Prepare feature vector for prediction
    X_new = np.array([[hour, day]])

    # Predict timestamp
    predicted_timestamp = model.predict(X_new)

    # Convert to human-readable format
    predicted_time = unix_to_human(predicted_timestamp[0])
    return predicted_time

# Check if the script is run via PHP (POST method)
if __name__ == "__main__":
    # Read input passed from PHP via environment variables (sent via POST)
    candidate = sys.stdin.readline().strip()
    interviewer = sys.stdin.readline().strip()
    hour = int(sys.stdin.readline().strip())
    day = int(sys.stdin.readline().strip())

    # Call the prediction function
    predicted_time = predict_interview_time(candidate, interviewer, hour, day)

    # Output the predicted interview time
    print(predicted_time)
