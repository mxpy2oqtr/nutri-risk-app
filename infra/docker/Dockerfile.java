# Etapa de build
FROM maven:3.9.6-eclipse-temurin-17 AS build
WORKDIR /app

# Copiar solo el pom.xml para aprovechar la caché de Docker
COPY pom.xml .
RUN ./mvnw dependency:go-offline -B

# Copiar el resto del código
COPY src ./src

# ¡HACER EJECUTABLE!
RUN chmod +x mvnw

# Compilar SIN tests
RUN ./mvnw package -DskipTests

# Etapa final
FROM eclipse-temurin:17-jre-alpine

# Crear usuario no root
RUN addgroup -g 1000 appgroup && \
    adduser -u 1000 -G appgroup -s /bin/sh -D appuser

WORKDIR /app
COPY --from=build /app/target/risk-service-0.0.1-SNAPSHOT.jar app.jar

# Cambiar a usuario no root
USER appuser

EXPOSE 8081
ENTRYPOINT ["java", "-jar", "app.jar"]
