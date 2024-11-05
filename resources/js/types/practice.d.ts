export interface Practice {
    id: number;
    user_id: number;
    tiempo: number;
    total_palabras: number;
    palabras_correctas: number;
    ppm: number;
    dificultad: string;
}
