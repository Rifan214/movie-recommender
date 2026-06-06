from flask import Flask, request, jsonify
import pandas as pd
import numpy as np
from sentence_transformers import SentenceTransformer
from sklearn.metrics.pairwise import cosine_similarity
import re
from sklearn.feature_extraction.text import ENGLISH_STOP_WORDS

app = Flask(__name__)

# Load dataset
# df = pd.read_csv("movie_dataset.csv.zip", compression='zip')
# df = df[['title', 'overview', 'id']].dropna()
df = pd.read_csv("imdb_movies_data.csv")
df = df[['title', 'plot', 'id']].dropna()



# df = pd.read_csv('imdb_movies_data.csv')
# df.rename(columns={'plot': 'overview'}, inplace=True)
# df = df[['title', 'overview']]
# df.dropna(inplace=True)



df.head()


def preprocess(text):
    text = text.lower()
    text = re.sub(r'[^a-z\s]', '', text)
    tokens = [t for t in text.split() if t not in ENGLISH_STOP_WORDS]
    return ' '.join(tokens)

df['clean_plot'] = df['plot'].apply(preprocess)

model = SentenceTransformer('all-MiniLM-L6-v2')
embeddings = model.encode(df['clean_plot'].tolist(), normalize_embeddings=True)
similarity_matrix = cosine_similarity(embeddings)

@app.route("/recommend", methods=["POST"])
def recommend():
    title = request.json.get("title")
    top_n = 5

    if title not in df['title'].values:
        return jsonify([])

    idx = df[df['title'] == title].index[0]
    sim_scores = list(enumerate(similarity_matrix[idx]))
    sim_scores = sorted(sim_scores, key=lambda x: x[1], reverse=True)[1:top_n+1]

    results = []
    for i, score in sim_scores:
        results.append({
            "title": df.iloc[i]['title'],
            "similarity": round(float(score), 3)
        })

    return jsonify(results)

if __name__ == "__main__":
    app.run(debug=True)
