CREATE TABLE IF NOT EXISTS tasks (
    id SERIAL PRIMARY KEY,
    meeting_id INTEGER REFERENCES meetings(id) ON DELETE CASCADE,
    assigned_to INTEGER REFERENCES users(id),
    description TEXT NOT NULL,
    due_date DATE,
    status VARCHAR(20) DEFAULT 'pending'
);