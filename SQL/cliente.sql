-- Table: public.cliente

-- DROP TABLE public.cliente;

CREATE TABLE public.cliente
(
  cli_codigo integer NOT NULL DEFAULT nextval('cliente_cli_codigo_seq'::regclass),
  cli_nome character varying(100),
  cli_autodata timestamp without time zone NOT NULL DEFAULT now(),
  CONSTRAINT cliente_pkey PRIMARY KEY (cli_codigo)
)
WITH (
  OIDS=FALSE
);
ALTER TABLE public.cliente
  OWNER TO api;