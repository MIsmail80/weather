<template>
  <div>
    <div class="card">
      <div class="card-header">Weather App</div>

      <div class="card-body">
        <h3>{{city}}</h3>
        <hr>
        <h3>Weather</h3>
        <p>
          {{weather}}
          <img :src="icon">
        </p>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  mounted() {
    axios.get("/weather").then(res => {
      this.city = res.data.city;
      this.weather = res.data.weather.description;
      this.icon =
        "http://openweathermap.org/img/w/" + res.data.weather.icon + ".png";
      console.log(res);
    });
  },

  data() {
    return {
      city: "",
      weather: "",
      icon: ""
    };
  }
};
</script>
