let foods = [];

// Cargar alimentos desde Laravel API
async function loadFoods() {
  const status = document.getElementById('status');
  try {
    status.textContent = 'Conectando a la API...';
    const res = await fetch('http://localhost:8000/api/foods');
    if (!res.ok) throw new Error('API no disponible');
    foods = await res.json();

    const select = document.getElementById('food');
    select.innerHTML = '<option value="">-- Selecciona un alimento --</option>';
    foods.forEach(f => {
      const opt = new Option(`${f.name} (${f.carbs}g carbs)`, f.id);
      select.add(opt);
    });

    status.innerHTML = '<span class="text-green-600">API conectada</span>';
  } catch (e) {
    document.getElementById('status').innerHTML = '<span class="text-red-600">Error: API no disponible. ¿Laravel está corriendo?</span>';
    console.error(e);
  }
}

// Analizar con IA
async function analyze() {
  const foodId = document.getElementById('food').value;
  const qty = document.getElementById('qty').value || 1;
  const resultDiv = document.getElementById('result');
  const content = document.getElementById('result-content');

  if (!foodId) {
    alert('Por favor, selecciona un alimento');
    return;
  }

  try {
    resultDiv.classList.add('hidden');
    content.innerHTML = '<p class="text-gray-600">Analizando con IA...</p>';

    const food = foods.find(f => f.id == foodId);
    const res = await fetch('http://localhost:8081/api/analyze', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ carbs: food.carbs * qty, gluten: food.gluten })
    });

    const data = await res.json();

    content.innerHTML = `
      <p><strong>Alimento:</strong> <span class="text-teal-600 font-semibold">${food.name} × ${qty}</span></p>
      <p><strong>Riesgo glucémico:</strong>
        <span class="${data.riesgo_glucemico === 'ALTO' ? 'text-red-600 font-bold' : 'text-green-600 font-semibold'}">
          ${data.riesgo_glucemico}
        </span>
      </p>
      <p><strong>Alergia gluten:</strong>
        <span class="${data.alergia_gluten === 'ALTO' ? 'text-red-600 font-bold' : 'text-green-600 font-semibold'}">
          ${data.alergia_gluten}
        </span>
      </p>
      <p><strong>Predicción IA:</strong>
        <span class="text-purple-600 font-semibold">${data.ia_prediccion}</span>
      </p>
    `;

    resultDiv.classList.remove('hidden');
  } catch (e) {
    content.innerHTML = '<p class="text-red-600">Error de conexión con el backend de IA.</p>';
    resultDiv.classList.remove('hidden');
    console.error(e);
  }
}

// Cargar al iniciar
loadFoods();
