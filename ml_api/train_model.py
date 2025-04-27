import pandas as pd
from sklearn.model_selection import train_test_split
from sklearn.svm import SVR  # Support Vector Regression (instead of SVC)
from sklearn.linear_model import LinearRegression
from sklearn.tree import DecisionTreeRegressor
from sklearn.ensemble import RandomForestRegressor
from sklearn.metrics import mean_squared_error, mean_absolute_error, r2_score
from sklearn.preprocessing import LabelEncoder  # For encoding the target variable
import matplotlib.pyplot as plt

# Load the dataset
def load_data():
    # Load dataset from the correct path
    data = pd.read_csv('C:\\xampp\\htdocs\\PlacementPortalCollege\\ml_api\\historical_interviews.csv')
    
    # Convert interview_time to timestamp (seconds since epoch)
    data['interview_time'] = pd.to_datetime(data['interview_time']).astype('int64') / 10**9  # Convert to timestamp
    
    return data

def train_model():
    data = load_data()

    # Feature selection (assuming 'interview_time' and 'interviewer' are the features)
    X = data[['interview_time', 'interviewer']]  # Features
    y = data['candidate']  # Target variable (assuming 'candidate' is categorical)

    # Encode the categorical 'candidate' target variable into numerical values
    label_encoder = LabelEncoder()
    y = label_encoder.fit_transform(y)

    # Convert categorical 'interviewer' to numerical codes
    X.loc[:, 'interviewer'] = X['interviewer'].astype('category').cat.codes  # Fixing SettingWithCopyWarning

    # Split data into training and testing sets (80% training, 20% testing)
    X_train, X_test, y_train, y_test = train_test_split(X, y, test_size=0.2, random_state=42)

    # Define the models to be used for training
    models = {
        'SVM (SVR)': SVR(),  # Use SVR for regression
        'Linear Regression': LinearRegression(),
        'Decision Tree': DecisionTreeRegressor(),
        'Random Forest': RandomForestRegressor()
    }

    # Train and evaluate each model
    for model_name, model in models.items():
        model.fit(X_train, y_train)  # Train the model
        y_pred = model.predict(X_test)  # Make predictions

        # Output model evaluation metrics
        print(f"Results for {model_name}:")
        print("R²:", r2_score(y_test, y_pred))
        print("MSE:", mean_squared_error(y_test, y_pred))
        print("MAE:", mean_absolute_error(y_test, y_pred))
        print("-" * 40)

        # Plot and save prediction vs actual results
        plt.figure(figsize=(10, 6))
        plt.scatter(y_test, y_pred, color='blue', label='Predicted vs Actual')
        plt.plot([y_test.min(), y_test.max()], [y_test.min(), y_test.max()], color='red', linewidth=2)  # Ideal line
        plt.title(f'{model_name} Prediction vs Actual')
        plt.xlabel('Actual')
        plt.ylabel('Predicted')
        plt.legend()
        plt.savefig(f'C:\\xampp\\htdocs\\PlacementPortalCollege\\ml_api\\assets\\{model_name}_prediction.png')
        plt.close()

# Run the training and evaluation
train_model()
