import pandas as pd

# Load dataset
df = pd.read_csv('movie_dataset.csv.zip', compression='zip')

# Print columns
print("Columns:", df.columns.tolist())
print("\nDataset shape:", df.shape)
print("\nFirst 3 rows:")
print(df.head(3))
print("\nData types:")
print(df.dtypes)
