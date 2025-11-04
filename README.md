# NutriRisk App – MVP

**App para prevención de riesgos nutricionales**: diabetes, alergias (gluten, nueces, etc.), obesidad, deficiencias.

## Funcionalidades Clave (MVP - 4 semanas)
| Feature | Estado | Servicio |
|---------|--------|----------|
| Registro / Login de usuarios | ✅ | PHP (Laravel) |
| Ingreso manual de comidas (texto o selección) | ✅ | PHP + JS |
| Detección de alergenos (gluten, nueces, lácteos) | ✅ | PHP + Java |
| Estimación de riesgo glucémico (picos de azúcar) | ✅ | Java |
| Alertas en tiempo real | ✅ | Frontend JS |
| Dashboard: consumo diario/semanal | ✅ | Frontend (Chart.js) |
| Exportar reporte (PDF/CSV) | ⚙️ | Semana 4 |

## Arquitectura (Microservicios)
```
┌─────────────────────────────────────────────────┐
│                   FRONTEND                      │
│ (HTML + TailwindCSS + Chart.js + JS)            │
│ • Interfaz de usuario                           │
│ • Dashboard visual                              │
│ • Alertas en tiempo real                        │
└───────────────────────────┬─────────────────────┘
                            │
                            │ (API Calls)
                            ↓
┌─────────────────────────────────────────────────┐
│             PHP LARAVEL SERVICE                │
│ • Gestión de usuarios (/users)                 │
│ • Registro de alimentos (/foods)               │
│ • Autenticación y autorización                 │
└───────────────────────────┬─────────────────────┘
                            │
                            │ (Análisis solicitado)
                            ↓
┌─────────────────────────────────────────────────┐
│           JAVA SPRING BOOT SERVICE             │
│ • Análisis de alergenos (/analyze)             │
│ • Cálculo de riesgo glucémico                  │
│ • Procesamiento nutricional avanzado           │
└───────────────────────────┬─────────────────────┘
                            │
                            │ (Persistencia)
                            ↓
┌─────────────────────────────────────────────────┐
│                  POSTGRESQL DB                 │
│ • Almacenamiento de todos los datos            │
│ • Historial de usuarios y análisis             │
└─────────────────────────────────────────────────┘
```

## Tecnologías
- **Java 21 + Spring Boot** → análisis de riesgos (lógica compleja)
- **PHP 8.3 + Laravel** → gestión de usuarios y alimentos
- **PostgreSQL** → base de datos
- **Docker + Kubernetes (Minikube)** → contenedores y orquestación
- **Frontend**: HTML + TailwindCSS + Chart.js
- **APIs**: REST + JSON


## 📋 Flujo de Datos

1. **Usuario** → Frontend (interfaz web)
2. **Frontend** → PHP Laravel (registro, login, alimentos)
3. **PHP Laravel** → Java Spring Boot (análisis nutricional)
4. **Java Spring Boot** → PostgreSQL (guardar resultados)
5. **PostgreSQL** → Todos los servicios (consulta de datos)

## 🛠️ Tecnologías

- **Frontend**: HTML5 + TailwindCSS + Chart.js + JavaScript
- **Backend PHP**: PHP 8.3 + Laravel (usuarios y alimentos)
- **Backend Java**: Java 21 + Spring Boot (análisis de riesgos)
- **Base de datos**: PostgreSQL
- **Contenedores**: Docker + Docker Compose
- **APIs**: REST + JSON

## 🚀 Setup Rápido

```bash
# Clonar proyecto
git clone https://github.com/mxpy2oqtr/nutri-risk-app.git
cd nutri-risk-app

# Ejecutar con Docker
docker-compose up -d
```

-------------------------------------------------------


### Servicios y Responsabilidades

#### 🎨 Frontend (HTML/JS/Chart.js)
- **Tecnología**: HTML5, TailwindCSS, JavaScript, Chart.js
- **Responsabilidad**: Interfaz de usuario, visualización de datos
- **Comunicación**: Fetch API hacia backend PHP

#### 🔐 PHP Laravel Service
- **Tecnología**: PHP 8.3, Laravel Framework
- **Endpoints**:
  - `POST /api/register` - Registro de usuarios
  - `POST /api/login` - Autenticación
  - `POST /api/foods` - Registrar alimentos consumidos
  - `GET /api/foods` - Obtener historial de alimentos
- **Responsabilidad**: Gestión de usuarios y registro de alimentos

#### 🔬 Java Spring Boot Service
- **Tecnología**: Java 21, Spring Boot
- **Endpoints**:
  - `POST /api/analyze` - Análisis de riesgo nutricional
  - `GET /api/risks/{userId}` - Obtener historial de riesgos
- **Responsabilidad**: Análisis avanzado de riesgos (alergenos, glucosa, etc.)

#### 💾 PostgreSQL Database
- **Tecnología**: PostgreSQL 15+
- **Esquemas**: usuarios, alimentos, análisis_riesgos, historial
- **Responsabilidad**: Almacenamiento persistente de datos

### Flujo de una Consulta Típica
1. Usuario ingresa alimento en frontend
2. Frontend envía a PHP Laravel (`POST /api/foods`)
3. PHP Laravel guarda en PostgreSQL y envía a Java (`POST /api/analyze`)
4. Java Spring Boot analiza riesgos y devuelve resultados
5. Frontend muestra alertas y actualiza dashboard

## 🚀 Ejecución
```bash
docker-compose up -d

--------------------------------------------------------

📅 Demo (Semana 4)
[Video demo aquí]

¡Entrega antes del 4 de diciembre!
