export interface Forecast {
  forecast_date: string;
  min_temp: string;
  max_temp: string;
  weather: string;
  weather_icon: string;
}

export interface Location {
  id: number;
  name: string;
  user_id: number;
  forecasts: Forecast[];
}

export interface LocationState {
  locations: Location[];
  errors: Errors;
}

export interface Errors {
  [key: string]: string[];
}