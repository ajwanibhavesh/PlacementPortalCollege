import pandas as pd
from datetime import datetime
import sys

def load_data():
    data = pd.read_csv('C:\\xampp\\htdocs\\PlacementPortalCollege\\ml_api\\historical_interviews.csv')
    data['interview_time'] = pd.to_datetime(data['interview_time'])
    return data

def check_conflict(interview_time, interviewer):
    data = load_data()
    interview_time = pd.to_datetime(interview_time)
    conflict = data[(data['interviewer'] == interviewer) & (data['interview_time'] == interview_time)]

    if len(conflict) > 0:
        return "Conflict detected! This interviewer is already scheduled at this time."
    else:
        return "Interview Scheduled Successfully."

if __name__ == "__main__":
    if len(sys.argv) < 4:
        print("Error: Not enough arguments.")
        sys.exit(1)

    date_arg = sys.argv[1]  # YYYY-MM-DD
    time_arg = sys.argv[2]  # HH:MM:SS
    interviewer_arg = sys.argv[3]

    full_datetime = f"{date_arg} {time_arg}"
    result = check_conflict(full_datetime, interviewer_arg)
    print(result)
