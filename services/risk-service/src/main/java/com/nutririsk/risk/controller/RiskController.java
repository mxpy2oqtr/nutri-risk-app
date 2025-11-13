package com.nutririsk.risk.controller;

import com.nutririsk.risk.dto.AnalysisRequest;
import com.nutririsk.risk.service.RiskService;
import jakarta.validation.Valid;
import org.springframework.web.bind.annotation.*;
import java.util.Map;

@RestController
@RequestMapping("/api/analyze")
@CrossOrigin(origins = "http://localhost:8000")
public class RiskController {

    private final RiskService riskService;

    public RiskController(RiskService riskService) {
        this.riskService = riskService;
    }

    @PostMapping
    public Map<String, Object> analyze(@Valid @RequestBody AnalysisRequest payload) {
        return riskService.analyze(payload);
    }
}
