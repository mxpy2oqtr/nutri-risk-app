package com.nutririsk.risk.controller;

import org.springframework.web.bind.annotation.*;
import java.util.Map;

@RestController
@RequestMapping("/api/analyze")
@CrossOrigin
public class RiskController {
    @PostMapping
    public Map<String, Object> analyze(@RequestBody Map<String, Object> payload) {
        double carbs = ((Number) payload.getOrDefault("carbs", 0)).doubleValue();
        boolean gluten = Boolean.TRUE.equals(payload.get("gluten"));

        String ia = carbs > 60 ? "Pico alto (>180 mg/dL)" : "Estable";

        return Map.of(
            "riesgo_glucemico", carbs > 50 ? "ALTO" : "BAJO",
            "alergia_gluten", gluten ? "ALTO" : "Seguro",
            "ia_prediccion", ia
        );
    }
}
