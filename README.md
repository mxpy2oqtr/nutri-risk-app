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
[Frontend: HTML/JS]
↓ (fetch API)
[API Gateway - futuro] → /users, /foods → [PHP Service: Laravel]
→ /analyze → [Java Service: Spring Boot]
↓
[PostgreSQL]


## Tecnologías
- **Java 21 + Spring Boot** → análisis de riesgos (lógica compleja)
- **PHP 8.3 + Laravel** → gestión de usuarios y alimentos
- **PostgreSQL** → base de datos
- **Docker + Kubernetes (Minikube)** → contenedores y orquestación
- **Frontend**: HTML + TailwindCSS + Chart.js
- **APIs**: REST + JSON

## Setup Rápido

```bash
docker-compose up -d

graph TD
    A[Frontend<br/>HTML + JS + Chart.js] -->|POST /api/meals| B[PHP Service<br/>Laravel]
    A -->|GET /dashboard| B
    B -->|HTTP POST /analyze| C[Java Service<br/>Spring Boot]
    B --> D[(PostgreSQL)]
    C --> D
    subgraph "Microservicios"
        B
        C
    end
