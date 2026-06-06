import pandas as pd

# Load dataset
df = pd.read_csv('movie_dataset.csv.zip', compression='zip')

# Check first few IDs and titles
print("Sample data:")
print(df[['id', 'title', 'overview']].head(10))
