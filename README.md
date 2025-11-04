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
┌─────────────────┐
│ Frontend        │  # HTML + TailwindCSS + Chart.js
│ (HTML/JS)       │
└─────────┬───────┘
          │ (Fetch API)
          ↓
┌─────────────────┐
│ PHP Laravel     │  # Gestión de usuarios y alimentos
│ Service         │  → /users, /foods
└─────────┬───────┘
          │
          ↓
┌─────────────────┐
│ Java Spring     │  # Análisis de riesgos nutricionales
│ Boot Service    │  → /analyze
└─────────┬───────┘
          │
          ↓
┌─────────────────┐
│ PostgreSQL      │  # Base de datos principal
│ Database        │
└─────────────────┘
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
