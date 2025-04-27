import pandas as pd
import matplotlib.pyplot as plt
from sklearn.linear_model import LinearRegression
from sklearn.svm import SVR
from sklearn.ensemble import RandomForestRegressor
from sklearn.tree import DecisionTreeRegressor
from sklearn.metrics import mean_squared_error, mean_absolute_error, r2_score
import os

# Read CSV
df = pd.read_csv("placement.csv")

# Clean column names by removing extra spaces and quotation marks
df.columns = df.columns.str.replace('"', '').str.strip()

# Features & target
X = df[['Academic_Year']]

# Apply changes using .loc to avoid SettingWithCopyWarning
X.loc[:, 'Academic_Year'] = X['Academic_Year'].apply(lambda x: str(x).replace('-', ''))
X = X.apply(lambda x: x.astype(int))
y = df['No_Of_Recruited_Students']

# Directory for charts
os.makedirs("assets", exist_ok=True)

# 1. Placement trend over years (Bar Chart)
plt.figure(figsize=(10, 6))
df_grouped = df.groupby('Academic_Year')['No_Of_Recruited_Students'].sum()
df_grouped.plot(kind='bar', color='skyblue')
plt.title('Placement Trend Over Years')
plt.xlabel('Academic Year')
plt.ylabel('No of Recruited Students')
plt.tight_layout()
plt.savefig("assets/placement_trend_over_years.png")

# 2. Top 10 hiring companies (Pie Chart)
top_companies = df.groupby('Company_Name')['No_Of_Recruited_Students'].sum().nlargest(10)
plt.figure(figsize=(8, 8))
top_companies.plot(kind='pie', autopct='%1.1f%%', colors=plt.cm.Paired.colors)
plt.title('Top 10 Hiring Companies')
plt.ylabel('')
plt.tight_layout()
plt.savefig("assets/top_10_hiring_companies_pie_chart.png")

# 3. Future trends (Dotted Points for Future Years)
# Assuming future academic years as a prediction (just an example of future data points)
future_years = [2023, 2024, 2025, 2026, 2027]

# Train the model (Example: Using Linear Regression for future predictions)
lr_model = LinearRegression()
lr_model.fit(X, y)

# Predict future values based on the Linear Regression model
future_predictions = [lr_model.predict(pd.DataFrame([[year]], columns=['Academic_Year']))[0] for year in future_years]

# Calculating y-axis limits based on historical and predicted data
min_value = min(y.min(), min(future_predictions))  # Minimum value between actual data and future predictions
max_value = max(y.max(), max(future_predictions))  # Maximum value between actual data and future predictions

# Adding buffer to the y-axis range for visual clarity
buffer = (max_value - min_value) * 0.1  # 10% buffer on top

# Plotting dotted points for future predictions
plt.figure(figsize=(10, 6))
plt.scatter(future_years, future_predictions, color='green', marker='o', label='Future Predictions', s=100)
plt.title('Future Trends of Recruited Students (Dotted Points)')
plt.xlabel('Academic Year')
plt.ylabel('Predicted Number of Students')

# Set dynamic y-axis limits based on historical and future data
plt.ylim(min_value - buffer, max_value + buffer)

plt.legend()
plt.tight_layout()
plt.savefig("assets/future_trends_dotted_points.png")

# 4. Box plot for Placement Data
plt.figure(figsize=(10, 6))
df.boxplot(column='No_Of_Recruited_Students', by='Academic_Year', grid=False, patch_artist=True, boxprops=dict(facecolor='lightgreen', color='green'), whiskerprops=dict(color='green'))
plt.title('Box Plot for Placement Data')
plt.suptitle('')  # Remove default title
plt.xlabel('Academic Year')
plt.ylabel('No of Recruited Students')
plt.tight_layout()
plt.savefig("assets/placement_box_plot.png")

# ---------------------------------------------
# Train models and display metrics
# ---------------------------------------------

# 1. Linear Regression
lr_model = LinearRegression()
lr_model.fit(X, y)
lr_predictions = lr_model.predict(X)

print("Linear Regression Results:")
print(f"R²: {r2_score(y, lr_predictions):.4f}")
print(f"MSE: {mean_squared_error(y, lr_predictions):.4f}")
print(f"MAE: {mean_absolute_error(y, lr_predictions):.4f}")
print()

# 2. Support Vector Machine (SVM)
svm_model = SVR()
svm_model.fit(X, y)
svm_predictions = svm_model.predict(X)

print("SVM Results:")
print(f"R²: {r2_score(y, svm_predictions):.4f}")
print(f"MSE: {mean_squared_error(y, svm_predictions):.4f}")
print(f"MAE: {mean_absolute_error(y, svm_predictions):.4f}")
print()

# 3. Random Forest
rf_model = RandomForestRegressor()
rf_model.fit(X, y)
rf_predictions = rf_model.predict(X)

print("Random Forest Results:")
print(f"R²: {r2_score(y, rf_predictions):.4f}")
print(f"MSE: {mean_squared_error(y, rf_predictions):.4f}")
print(f"MAE: {mean_absolute_error(y, rf_predictions):.4f}")
print()

# 4. Decision Tree
dt_model = DecisionTreeRegressor()
dt_model.fit(X, y)
dt_predictions = dt_model.predict(X)

print("Decision Tree Results:")
print(f"R²: {r2_score(y, dt_predictions):.4f}")
print(f"MSE: {mean_squared_error(y, dt_predictions):.4f}")
print(f"MAE: {mean_absolute_error(y, dt_predictions):.4f}")
