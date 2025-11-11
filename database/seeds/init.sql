-- database/init.sql
-- Inicialización de la tabla 'foods' con datos realistas
-- NutriRisk App - 10 de noviembre de 2025

CREATE TABLE IF NOT EXISTS foods (
    id BIGSERIAL PRIMARY KEY,
    name VARCHAR(120) NOT NULL,
    carbs DECIMAL(6,2) NOT NULL DEFAULT 0.00,   -- gramos por 100g
    sugar DECIMAL(6,2) NOT NULL DEFAULT 0.00,   -- gramos por 100g
    gluten BOOLEAN NOT NULL DEFAULT FALSE,
    nuts BOOLEAN NOT NULL DEFAULT FALSE,
    dairy BOOLEAN NOT NULL DEFAULT FALSE,
    created_at TIMESTAMPTZ DEFAULT NOW(),
    updated_at TIMESTAMPTZ DEFAULT NOW()
);

-- Limpiar datos previos (opcional, para desarrollo)
TRUNCATE TABLE foods RESTART IDENTITY;

-- INSERTAR 15 ALIMENTOS REALISTAS
INSERT INTO foods (name, carbs, sugar, gluten, nuts, dairy) VALUES
('Pan blanco (100g)', 49.00, 5.00, TRUE,  FALSE, FALSE),
('Pan integral (100g)', 41.00, 4.20, TRUE,  FALSE, FALSE),
('Arroz blanco cocido (100g)', 28.00, 0.10, FALSE, FALSE, FALSE),
('Pasta cocida con gluten (100g)', 25.00, 0.80, TRUE,  FALSE, FALSE),
('Pasta sin gluten (100g)', 30.00, 1.50, FALSE, FALSE, FALSE),
('Manzana (1 unidad mediana)', 13.80, 10.40, FALSE, FALSE, FALSE),
('Plátano (1 unidad mediana)', 22.80, 12.20, FALSE, FALSE, FALSE),
('Zumo de naranja natural (200ml)', 22.00, 18.00, FALSE, FALSE, FALSE),
('Leche entera (200ml)', 9.60, 9.60, FALSE, FALSE, TRUE),
('Yogur natural sin azúcar (125g)', 4.50, 4.50, FALSE, FALSE, TRUE),
('Almendras (30g)', 6.50, 1.20, FALSE, TRUE,  FALSE),
('Nueces (30g)', 4.20, 0.80, FALSE, TRUE,  FALSE),
('Pollo a la plancha (100g)', 0.00, 0.00, FALSE, FALSE, FALSE),
('Salmón ahumado (100g)', 0.00, 0.00, FALSE, FALSE, FALSE),
('Galletas con avena y nueces (2 uds)', 32.00, 12.00, TRUE, TRUE,  FALSE)
ON CONFLICT (id) DO UPDATE SET
    name = EXCLUDED.name,
    carbs = EXCLUDED.carbs,
    sugar = EXCLUDED.sugar,
    gluten = EXCLUDED.gluten,
    nuts = EXCLUDED.nuts,
    dairy = EXCLUDED.dairy,
    updated_at = NOW();

-- Tabla para sesiones de Laravel
CREATE TABLE IF NOT EXISTS sessions (
    id VARCHAR(255) PRIMARY KEY,
    user_id BIGINT NULL,
    ip_address VARCHAR(45) NULL,
    user_agent TEXT NULL,
    payload TEXT NOT NULL,
    last_activity INTEGER NOT NULL
);

CREATE INDEX IF NOT EXISTS idx_sessions_user_id ON sessions(user_id);
CREATE INDEX IF NOT EXISTS idx_sessions_last_activity ON sessions(last_activity);


-- Índices para rendimiento
CREATE INDEX IF NOT EXISTS idx_foods_gluten ON foods(gluten) WHERE gluten = TRUE;
CREATE INDEX IF NOT EXISTS idx_foods_nuts ON foods(nuts) WHERE nuts = TRUE;
CREATE INDEX IF NOT EXISTS idx_foods_dairy ON foods(dairy) WHERE dairy = TRUE;
