<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Placement Trends</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            color: #333;
            margin-bottom: 40px;
        }

        h2 {
            text-align: center;
            color: #444;
            margin-bottom: 20px;
        }

        .graph {
            margin-bottom: 50px;
        }

        .graph img {
            display: block;
            margin: 0 auto;
            width: 100%;
            max-width: 600px;
            border: 2px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .graph img:hover {
            border-color: #5ab5d1;
            transform: scale(1.03);
            transition: 0.3s ease-in-out;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Placement Trends over the Years</h1>
        
        <!-- Bar chart for Placement Trend over Years -->
        <div class="graph">
            <h2>Placement Trend Over Years</h2>
            <img src="ml_api/assets/placement_trend_over_years.png" alt="Placement Trend Over Years">
        </div>
        
        <!-- Pie chart for Top 10 Hiring Companies -->
        <div class="graph">
            <h2>Top 10 Hiring Companies</h2>
            <img src="ml_api/assets/top_10_hiring_companies_pie_chart.png" alt="Top 10 Hiring Companies">
        </div>
        
        <!-- Dotted points for Future Trends -->
        <div class="graph">
            <h2>Future Trends of Recruited Students</h2>
            <img src="ml_api/assets/future_trends_dotted_points.png" alt="Future Trends">
        </div>
        
    
    </div>
</body>
</html>
