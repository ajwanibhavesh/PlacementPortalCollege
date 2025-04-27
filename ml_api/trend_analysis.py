import pandas as pd
import os

csv_file_path = "placementstats.csv"

# Check if file exists
if not os.path.exists(csv_file_path):
    print(f"Error: File '{csv_file_path}' not found!")
    exit()

# Load dataset
df = pd.read_csv(csv_file_path, encoding="utf-8")

# Strip spaces AND remove extra quotes from column names
df.columns = df.columns.str.strip().str.replace('"', '')

# Print updated column names to verify
print("Updated Columns in the dataset:", df.columns)

# Ensure column exists before grouping
if "Company_Name" not in df.columns:
    print("Error: 'Company_Name' column still not found!")
    exit()

# Now try grouping again
top_companies = df.groupby("Company_Name").size().nlargest(10)
print("Top Companies Analysis Successful!")
