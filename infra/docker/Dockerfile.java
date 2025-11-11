# Etapa de build
FROM maven:3.9.6-eclipse-temurin-17 AS build
WORKDIR /app

# Copiar TODO el proyecto
COPY . .

# ¡HACER EJECUTABLE!
RUN chmod +x mvnw

# Descargar dependencias
RUN ./mvnw dependency:go-offline -B

# Compilar SIN tests
RUN ./mvnw package -DskipTests

# Etapa final
FROM eclipse-temurin:17-jre-alpine
WORKDIR /app
COPY --from=build /app/target/risk-service-0.0.1-SNAPSHOT.jar app.jar
EXPOSE 8081
ENTRYPOINT ["java", "-jar", "app.jar"]
