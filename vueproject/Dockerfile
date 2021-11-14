
#FROM nginx:latest
#COPY dist/  /usr/share/nginx/vueproject/
#COPY ./vue.conf /etc/nginx/conf.d/vue.conf
# pull the Node.js Docker image

FROM node:lts


# устанавливаем простой HTTP-сервер для статики
RUN npm install -g http-server
RUN useradd -ms /bin/bash apps

#RUN usermod -u 1000 apps \
#  && groupmod -g 1000 apps

#RUN groupadd --gid 2000 node \
#  && useradd --uid 2000 --gid node --shell /bin/bash --create-home node


# делаем каталог 'app' текущим рабочим каталогом
WORKDIR /home/apps

# копируем оба 'package.json' и 'package-lock.json' (если есть)
COPY package*.json ./

# устанавливаем зависимости проекта
RUN npm install


# копируем файлы и каталоги проекта в текущий рабочий каталог (т.е. в каталог 'app')
COPY . .




# собираем приложение для production с минификацией
#RUN npm run build

EXPOSE 8080

CMD ["npm","run","serve"]
#CMD ["npm","run","build"]








