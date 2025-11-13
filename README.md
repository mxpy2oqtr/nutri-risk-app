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

## 🚀 Guía de Inicio Rápido

Esta guía te llevará desde la clonación del repositorio hasta tener la aplicación completamente funcional en tu entorno local usando Docker.

### **1. Prerrequisitos**

Antes de empezar, asegúrate de tener instaladas las siguientes herramientas:
- **Git**: Para clonar el repositorio.
- **Docker**: Para la gestión de contenedores.
- **Docker Compose**: Para orquestar los servicios de la aplicación.

### **2. Clonar el Repositorio**

Abre tu terminal, navega al directorio donde deseas guardar el proyecto y clona el repositorio de GitHub:

```bash
git clone https://github.com/tu-usuario/nutri-risk-app.git
cd nutri-risk-app
```

### **3. Configuración del Entorno**

El proyecto utiliza un archivo `.env` para gestionar las variables de entorno. Puedes empezar copiando el archivo de ejemplo:

```bash
cp .env.example .env
```
*No es necesario modificar este archivo para el entorno de desarrollo local, ya que los valores por defecto están configurados para funcionar con Docker Compose.*

### **4. Construir y Ejecutar los Contenedores**

Una vez dentro del directorio del proyecto, utiliza Docker Compose para construir las imágenes de los servicios y ejecutarlos en segundo plano (`-d`):

```bash
docker-compose build --no-cache && docker-compose up -d
```
- `build --no-cache`: Reconstruye las imágenes desde cero para asegurar que todos los cambios en los `Dockerfile` se apliquen correctamente.
- `up -d`: Inicia los contenedores en modo "detached" (segundo plano).

### **5. Verificar que Todo Funciona**

Después de ejecutar el comando anterior, los servicios pueden tardar un par de minutos en iniciarse completamente, especialmente la base de datos y el servicio de Java.

Puedes verificar el estado de los contenedores con:
```bash
docker-compose ps
```
Deberías ver todos los servicios (`nutri-db`, `nutri-php`, `nutri-java`) con el estado `Up` o `running`.

Para ver los logs en tiempo real de todos los servicios y depurar posibles errores:
```bash
docker-compose logs -f
```
Para ver los logs de un servicio específico (por ejemplo, el de Java):
```bash
docker-compose logs -f nutri-java
```

### **6. Acceder a la Aplicación**

Una vez que los contenedores estén en funcionamiento, puedes acceder a los servicios a través de los siguientes puertos:

- **Interfaz de Usuario (Frontend)**: [http://localhost:8000](http://localhost:8000)
- **API de PHP (Food Service)**: `http://localhost:8000/api/...`
- **API de Java (Risk Service)**: `http://localhost:8081/api/...`

### **7. Detener la Aplicación**

Para detener todos los servicios, ejecuta:
```bash
docker-compose down
```

-------------------------------------------------------

📅 Demo (Semana 4)
[Video demo aquí]

¡Entrega antes del 4 de diciembre!
