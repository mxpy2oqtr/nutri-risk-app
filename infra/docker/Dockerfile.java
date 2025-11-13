# Etapa de build
FROM maven:3.9.6-eclipse-temurin-17 AS build
WORKDIR /app

# Copiar el wrapper de Maven y el pom.xml
COPY .mvn/ .mvn
COPY mvnw mvnw.cmd pom.xml ./

# Hacer ejecutable el script de Maven
RUN chmod +x mvnw

# Descargar dependencias
RUN ./mvnw dependency:go-offline -B

# Copiar el resto del código fuente
COPY src ./src

# Compilar la aplicación sin ejecutar tests
RUN ./mvnw package -DskipTests

# Etapa final
FROM eclipse-temurin:17-jre-alpine

# Crear usuario no root
RUN addgroup -g 1000 appgroup && \
    adduser -u 1000 -G appgroup -s /bin/sh -D appuser

WORKDIR /app
COPY --chown=appuser:appgroup --from=build /app/target/risk-service-0.0.1-SNAPSHOT.jar app.jar

# Cambiar a usuario no root
USER appuser

EXPOSE 8081
ENTRYPOINT ["java", "-Dlogging.level.org.springframework=DEBUG", "-jar", "app.jar"]
