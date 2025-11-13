package com.nutririsk.risk.dto;

import jakarta.validation.constraints.Min;
import jakarta.validation.constraints.NotNull;
import lombok.Data;

@Data
public class AnalysisRequest {

    @NotNull(message = "carbs cannot be null")
    @Min(value = 0, message = "carbs must be greater than or equal to 0")
    private Double carbs;

    @NotNull(message = "gluten cannot be null")
    private Boolean gluten;
}
