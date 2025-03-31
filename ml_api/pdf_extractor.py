import sys
import pdfplumber
import pandas as pd

def extract_placement_data(pdf_path):
    data = []
    with pdfplumber.open(pdf_path) as pdf:
        for page in pdf.pages:
            text = page.extract_text()
            if text:
                lines = text.split("\n")
                for line in lines:
                    parts = line.split()
                    if len(parts) >= 3:  # Assuming format: Year | Total Students | Placed
                        try:
                            year = int(parts[0])
                            total_students = int(parts[1])
                            placed_students = int(parts[2])
                            placement_rate = (placed_students / total_students) * 100
                            data.append([year, total_students, placed_students, placement_rate])
                        except:
                            continue
    df = pd.DataFrame(data, columns=["Year", "Total Students", "Placed Students", "Placement Rate"])
    print(df.to_string(index=False))

if __name__ == "__main__":
    pdf_path = sys.argv[1]
    extract_placement_data(pdf_path)
