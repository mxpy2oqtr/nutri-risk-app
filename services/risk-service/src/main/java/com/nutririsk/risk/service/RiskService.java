package com.nutririsk.risk.service;

import com.nutririsk.risk.dto.AnalysisRequest;
import org.springframework.stereotype.Service;

import java.util.Map;

@Service
public class RiskService {

    public Map<String, Object> analyze(AnalysisRequest request) {
        double carbs = request.getCarbs();
        boolean gluten = request.getGluten();

        String ia = carbs > 60 ? "Pico alto (>180 mg/dL)" : "Estable";

        return Map.of(
                "riesgo_glucemico", carbs > 50 ? "ALTO" : "BAJO",
                "alergia_gluten", gluten ? "ALTO" : "Seguro",
                "ia_prediccion", ia
        );
    }
}
