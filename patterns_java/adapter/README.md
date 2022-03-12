# Adapter Pattern

El patrón de adaptador funciona como un puente entre dos interfaces incompatibles. Este tipo de patrón de diseño viene bajo patrón estructural ya que este patrón combina la capacidad de dos interfaces independientes.

Este patrón involucra a una sola clase que es responsable de unir funcionalidades de interfaces independientes o incompatibles. Un ejemplo de la vida real podría ser el caso de un lector de tarjetas que actúa como adaptador entre la tarjeta de memoria y una computadora portátil. Conecta la tarjeta de memoria al lector de tarjetas y el lector de tarjetas a la computadora portátil para que la tarjeta de memoria se pueda leer a través de la computadora portátil.

Estamos demostrando el uso del patrón Adaptador mediante el siguiente ejemplo en el que un dispositivo reproductor de audio solo puede reproducir archivos mp3 y desea usar un reproductor de audio avanzado capaz de reproducir archivos vlc y mp4.

## Implementación

Tenemos una interfaz MediaPlayer y una clase concreta AudioPlayer que implementa la interfaz MediaPlayer. AudioPlayer puede reproducir archivos de audio en formato mp3 de forma predeterminada.

Tenemos otra interfaz AdvancedMediaPlayer y clases concretas que implementan la interfaz AdvancedMediaPlayer. Estas clases pueden reproducir archivos en formato vlc y mp4.

Queremos que AudioPlayer también reproduzca otros formatos. Para lograr esto, hemos creado una clase de adaptador MediaAdapter que implementa la interfaz MediaPlayer y usa objetos AdvancedMediaPlayer para reproducir el formato requerido.

AudioPlayer usa la clase de adaptador MediaAdapter pasándole el tipo de audio deseado sin conocer la clase real que puede reproducir el formato deseado. AdapterPatternDemo, nuestra clase de demostración utilizará la clase AudioPlayer para reproducir varios formatos.

![UML Diagram](adapter_pattern_uml_diagram.jpg)

## Paso 1

Cree interfaces para Media Player y Advanced Media Player.

> MediaPlayer.java

```java
public interface MediaPlayer {
    public void play(String audioType, String fileName);
}
```

> AdvancedMediaPlayer.java

```java
public interface AdvancedMediaPlayer {
   public void playVlc(String fileName);
   public void playMp4(String fileName);
}
```

## Paso 2

Cree clases concretas implementando la interfaz AdvancedMediaPlayer.

> VlcPlayer.java

```java
public class VlcPlayer implements AdvancedMediaPlayer{
   @Override
   public void playVlc(String fileName) {
      System.out.println("Playing vlc file. Name: "+ fileName);
   }

   @Override
   public void playMp4(String fileName) {
      //do nothing
   }
}
```

> Mp4Player.java

```java
public class Mp4Player implements AdvancedMediaPlayer{

   @Override
   public void playVlc(String fileName) {
      //do nothing
   }

   @Override
   public void playMp4(String fileName) {
      System.out.println("Playing mp4 file. Name: "+ fileName);
   }
}
```

## Paso 3

Cree una clase de adaptador implementando la interfaz MediaPlayer.

> MediaAdapter.java

```java
public class MediaAdapter implements MediaPlayer {

   AdvancedMediaPlayer advancedMusicPlayer;

   public MediaAdapter(String audioType){

      if(audioType.equalsIgnoreCase("vlc") ){
         advancedMusicPlayer = new VlcPlayer();

      }else if (audioType.equalsIgnoreCase("mp4")){
         advancedMusicPlayer = new Mp4Player();
      }
   }

   @Override
   public void play(String audioType, String fileName) {

      if(audioType.equalsIgnoreCase("vlc")){
         advancedMusicPlayer.playVlc(fileName);
      }
      else if(audioType.equalsIgnoreCase("mp4")){
         advancedMusicPlayer.playMp4(fileName);
      }
   }
}
```

## Paso 4

Cree una clase concreta implementando la interfaz MediaPlayer.

> AudioPlayer.java

```java
public class AudioPlayer implements MediaPlayer {
   MediaAdapter mediaAdapter;

   @Override
   public void play(String audioType, String fileName) {

      //inbuilt support to play mp3 music files
      if(audioType.equalsIgnoreCase("mp3")){
         System.out.println("Playing mp3 file. Name: " + fileName);
      }

      //mediaAdapter is providing support to play other file formats
      else if(audioType.equalsIgnoreCase("vlc") || audioType.equalsIgnoreCase("mp4")){
         mediaAdapter = new MediaAdapter(audioType);
         mediaAdapter.play(audioType, fileName);
      }

      else{
         System.out.println("Invalid media. " + audioType + " format not supported");
      }
   }
}
```

## Paso 5

Utilice AudioPlayer para reproducir diferentes tipos de formatos de audio.

> AdapterPatternDemo.java

```java
public class AdapterPatternDemo {
   public static void main(String[] args) {
      AudioPlayer audioPlayer = new AudioPlayer();

      audioPlayer.play("mp3", "beyond the horizon.mp3");
      audioPlayer.play("mp4", "alone.mp4");
      audioPlayer.play("vlc", "far far away.vlc");
      audioPlayer.play("avi", "mind me.avi");
   }
}
```

## Paso 6

Verifique la salida.

```note
Playing mp3 file. Name: beyond the horizon.mp3
Playing mp4 file. Name: alone.mp4
Playing vlc file. Name: far far away.vlc
Invalid media. avi format not supported
```

---
:octocat: [Check more about me.](https://github.com/FernandoCalmet)

[![ko-fi](https://www.ko-fi.com/img/githubbutton_sm.svg)](https://ko-fi.com/T6T41JKMI)
