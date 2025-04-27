# predict_conflict.py
import sys
import pickle
from datetime import datetime, timedelta

# Read inputs
candidate = sys.argv[1]
interviewer = sys.argv[2]
interview_time_str = sys.argv[3]

# Load schedule
with open('interview_schedule.pkl', 'rb') as f:
    schedule = pickle.load(f)

# Convert string to datetime object
requested_time = datetime.strptime(interview_time_str, "%Y-%m-%d %H:%M:%S")

# Check for conflict
conflict = False
if interviewer in schedule:
    for scheduled_time in schedule[interviewer]:
        if requested_time == pd.to_datetime(scheduled_time):
            conflict = True
            break

if conflict:
    # Suggest next 5 available 15-minute slots
    suggestions = []
    delta = timedelta(minutes=15)
    next_slot = requested_time + delta
    for _ in range(5):
        if next_slot not in schedule[interviewer]:
            suggestions.append(next_slot.strftime("%Y-%m-%d %H:%M:%S"))
        next_slot += delta

    print("1|" + "|".join(suggestions))  # 1 for conflict
else:
    print("0")  # 0 for no conflict
