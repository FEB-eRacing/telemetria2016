long velocidade,contagiro,tempo;
long tempoMin,tempoHora,tempoSeg;
long posicaoX,posicaoY;

void setup(){
  Serial.begin(9600);
  randomSeed(analogRead(0));
}

void loop() {
  velocidade = random(0,150);
  contagiro = random(0,4000);
  tempoSeg = random(0,60);
  tempoMin = random(0,60);
  tempoHora = random(0,24);
  posicaoX = random(0,100);
  posicaoY = random(0,100);
  String V = "V";
  String C = "C";
  String T = "T";
  String P = ":";
  String X = "X";
  String Y = "Y";
  String F = "F";
  String mensagem = V+velocidade+C+contagiro+T+tempoHora+P+tempoMin+P+tempoSeg+X+posicaoX+Y+posicaoY+F;
  Serial.println(mensagem);

  delay(1000);
}
