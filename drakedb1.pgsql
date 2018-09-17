--
-- PostgreSQL database dump
--

-- Dumped from database version 9.5.6
-- Dumped by pg_dump version 9.5.6

SET statement_timeout = 0;
SET lock_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SET check_function_bodies = false;
SET client_min_messages = warning;
SET row_security = off;

--
-- Name: plpgsql; Type: EXTENSION; Schema: -; Owner: 
--

CREATE EXTENSION IF NOT EXISTS plpgsql WITH SCHEMA pg_catalog;


--
-- Name: EXTENSION plpgsql; Type: COMMENT; Schema: -; Owner: 
--

COMMENT ON EXTENSION plpgsql IS 'PL/pgSQL procedural language';


SET search_path = public, pg_catalog;

--
-- Name: e_fueltypes; Type: TYPE; Schema: public; Owner: drake
--

CREATE TYPE e_fueltypes AS ENUM (
    'LPG',
    'Benzyna',
    'Diesel'
);


ALTER TYPE e_fueltypes OWNER TO drake;

SET default_tablespace = '';

SET default_with_oids = false;

--
-- Name: insurance; Type: TABLE; Schema: public; Owner: drake
--

CREATE TABLE insurance (
    id integer NOT NULL,
    company character varying,
    startson date DEFAULT ('now'::text)::date,
    endson date DEFAULT ('now'::text)::date,
    price integer,
    pricenextyear integer,
    valid integer DEFAULT 0,
    insurancenumber character varying DEFAULT 0,
    vehicleid integer
);


ALTER TABLE insurance OWNER TO drake;

--
-- Name: insurance_id_seq; Type: SEQUENCE; Schema: public; Owner: drake
--

CREATE SEQUENCE insurance_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE insurance_id_seq OWNER TO drake;

--
-- Name: insurance_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: drake
--

ALTER SEQUENCE insurance_id_seq OWNED BY insurance.id;


--
-- Name: insurance_id_seq2; Type: SEQUENCE; Schema: public; Owner: drake
--

CREATE SEQUENCE insurance_id_seq2
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE insurance_id_seq2 OWNER TO drake;

--
-- Name: refuel; Type: TABLE; Schema: public; Owner: drake
--

CREATE TABLE refuel (
    id integer NOT NULL,
    type e_fueltypes,
    amount double precision,
    cost double precision,
    vehicle integer,
    date date DEFAULT now()
);


ALTER TABLE refuel OWNER TO drake;

--
-- Name: refuel_id_seq; Type: SEQUENCE; Schema: public; Owner: drake
--

CREATE SEQUENCE refuel_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE refuel_id_seq OWNER TO drake;

--
-- Name: refuel_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: drake
--

ALTER SEQUENCE refuel_id_seq OWNED BY refuel.id;


--
-- Name: refuel_id_seq2; Type: SEQUENCE; Schema: public; Owner: drake
--

CREATE SEQUENCE refuel_id_seq2
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE refuel_id_seq2 OWNER TO drake;

--
-- Name: service; Type: TABLE; Schema: public; Owner: drake
--

CREATE TABLE service (
    id integer NOT NULL,
    title character varying,
    description character varying,
    date date DEFAULT ('now'::text)::date,
    mileage integer,
    cost double precision,
    vehicle integer,
    type integer DEFAULT 1 NOT NULL
);


ALTER TABLE service OWNER TO drake;

--
-- Name: repair_id_seq; Type: SEQUENCE; Schema: public; Owner: drake
--

CREATE SEQUENCE repair_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE repair_id_seq OWNER TO drake;

--
-- Name: repair_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: drake
--

ALTER SEQUENCE repair_id_seq OWNED BY service.id;


--
-- Name: vehicle; Type: TABLE; Schema: public; Owner: drake
--

CREATE TABLE vehicle (
    id integer NOT NULL,
    type character varying,
    make character varying,
    capacity integer,
    year integer,
    insurance integer,
    photo character varying,
    rentcost integer DEFAULT 100,
    fueltype character varying DEFAULT 'Benzyna'::character varying NOT NULL
);


ALTER TABLE vehicle OWNER TO drake;

--
-- Name: vehicle_id_seq; Type: SEQUENCE; Schema: public; Owner: drake
--

CREATE SEQUENCE vehicle_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE vehicle_id_seq OWNER TO drake;

--
-- Name: vehicle_id_seq; Type: SEQUENCE OWNED BY; Schema: public; Owner: drake
--

ALTER SEQUENCE vehicle_id_seq OWNED BY vehicle.id;


--
-- Name: vehicle_id_seq2; Type: SEQUENCE; Schema: public; Owner: drake
--

CREATE SEQUENCE vehicle_id_seq2
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER TABLE vehicle_id_seq2 OWNER TO drake;

--
-- Name: id; Type: DEFAULT; Schema: public; Owner: drake
--

ALTER TABLE ONLY insurance ALTER COLUMN id SET DEFAULT nextval('insurance_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: drake
--

ALTER TABLE ONLY refuel ALTER COLUMN id SET DEFAULT nextval('refuel_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: drake
--

ALTER TABLE ONLY service ALTER COLUMN id SET DEFAULT nextval('repair_id_seq'::regclass);


--
-- Name: id; Type: DEFAULT; Schema: public; Owner: drake
--

ALTER TABLE ONLY vehicle ALTER COLUMN id SET DEFAULT nextval('vehicle_id_seq'::regclass);


--
-- Data for Name: insurance; Type: TABLE DATA; Schema: public; Owner: drake
--

COPY insurance (id, company, startson, endson, price, pricenextyear, valid, insurancenumber, vehicleid) FROM stdin;
8	Axa Direct	2016-10-31	2017-10-30	500	\N	0	M4312432	28
7	Axa Direct	2017-05-31	2018-06-01	820	\N	0	M3342314312	26
9	TUW	2016-08-08	2017-08-09	468	\N	0	34214321	29
10	Link4	2016-09-21	2017-09-22	540	\N	0	M43214321	30
\.


--
-- Name: insurance_id_seq; Type: SEQUENCE SET; Schema: public; Owner: drake
--

SELECT pg_catalog.setval('insurance_id_seq', 10, true);


--
-- Name: insurance_id_seq2; Type: SEQUENCE SET; Schema: public; Owner: drake
--

SELECT pg_catalog.setval('insurance_id_seq2', 1, false);


--
-- Data for Name: refuel; Type: TABLE DATA; Schema: public; Owner: drake
--

COPY refuel (id, type, amount, cost, vehicle, date) FROM stdin;
10	Benzyna	30	120	28	2017-07-01
11	LPG	76	135	28	2017-07-01
12	Diesel	40	159.990000000000009	26	2017-07-02
13	Diesel	45	170	30	2017-07-02
\.


--
-- Name: refuel_id_seq; Type: SEQUENCE SET; Schema: public; Owner: drake
--

SELECT pg_catalog.setval('refuel_id_seq', 13, true);


--
-- Name: refuel_id_seq2; Type: SEQUENCE SET; Schema: public; Owner: drake
--

SELECT pg_catalog.setval('refuel_id_seq2', 1, false);


--
-- Name: repair_id_seq; Type: SEQUENCE SET; Schema: public; Owner: drake
--

SELECT pg_catalog.setval('repair_id_seq', 8, true);


--
-- Data for Name: service; Type: TABLE DATA; Schema: public; Owner: drake
--

COPY service (id, title, description, date, mileage, cost, vehicle, type) FROM stdin;
2			2017-07-10	165000	99	28	0
3	Silnikowy	Olej Mobil1 10W40	2017-07-04	188000	100	28	1
6			2017-05-01	113000	99	26	0
7			2017-03-21	159000	161	29	0
8			2016-12-30	240000	99	30	0
\.


--
-- Data for Name: vehicle; Type: TABLE DATA; Schema: public; Owner: drake
--

COPY vehicle (id, type, make, capacity, year, insurance, photo, rentcost, fueltype) FROM stdin;
26	Osobowy	Citroen C3	1400	2006	7	download.jpg	60	Diesel
29	Osobowy	Honda Civic	1698	2002	9	1200px-2001-2003_Honda_Civic_sedan.jpg	\N	LPG
30	Osobowy	Mazda 6	1900	2007	10		\N	Diesel
28	Osobowy	Cadillac Deville	4600	2003	8	236031.jpg	100	LPG
\.


--
-- Name: vehicle_id_seq; Type: SEQUENCE SET; Schema: public; Owner: drake
--

SELECT pg_catalog.setval('vehicle_id_seq', 30, true);


--
-- Name: vehicle_id_seq2; Type: SEQUENCE SET; Schema: public; Owner: drake
--

SELECT pg_catalog.setval('vehicle_id_seq2', 1, false);


--
-- Name: insurance_pkey; Type: CONSTRAINT; Schema: public; Owner: drake
--

ALTER TABLE ONLY insurance
    ADD CONSTRAINT insurance_pkey PRIMARY KEY (id);


--
-- Name: refuel_pkey; Type: CONSTRAINT; Schema: public; Owner: drake
--

ALTER TABLE ONLY refuel
    ADD CONSTRAINT refuel_pkey PRIMARY KEY (id);


--
-- Name: repair_pkey; Type: CONSTRAINT; Schema: public; Owner: drake
--

ALTER TABLE ONLY service
    ADD CONSTRAINT repair_pkey PRIMARY KEY (id);


--
-- Name: vehicle_pkey; Type: CONSTRAINT; Schema: public; Owner: drake
--

ALTER TABLE ONLY vehicle
    ADD CONSTRAINT vehicle_pkey PRIMARY KEY (id);


--
-- Name: insurance_insurancenumber_uindex; Type: INDEX; Schema: public; Owner: drake
--

CREATE UNIQUE INDEX insurance_insurancenumber_uindex ON insurance USING btree (insurancenumber);


--
-- Name: insurance_vehicle_id_fk; Type: FK CONSTRAINT; Schema: public; Owner: drake
--

ALTER TABLE ONLY insurance
    ADD CONSTRAINT insurance_vehicle_id_fk FOREIGN KEY (vehicleid) REFERENCES vehicle(id) ON DELETE CASCADE;


--
-- Name: refuel_vehicle_id_fk; Type: FK CONSTRAINT; Schema: public; Owner: drake
--

ALTER TABLE ONLY refuel
    ADD CONSTRAINT refuel_vehicle_id_fk FOREIGN KEY (vehicle) REFERENCES vehicle(id) ON DELETE CASCADE;


--
-- Name: repair_vehicle_id_fk; Type: FK CONSTRAINT; Schema: public; Owner: drake
--

ALTER TABLE ONLY service
    ADD CONSTRAINT repair_vehicle_id_fk FOREIGN KEY (vehicle) REFERENCES vehicle(id);


--
-- Name: vehicle_insurance_id_fk; Type: FK CONSTRAINT; Schema: public; Owner: drake
--

ALTER TABLE ONLY vehicle
    ADD CONSTRAINT vehicle_insurance_id_fk FOREIGN KEY (insurance) REFERENCES insurance(id);


--
-- Name: public; Type: ACL; Schema: -; Owner: postgres
--

REVOKE ALL ON SCHEMA public FROM PUBLIC;
REVOKE ALL ON SCHEMA public FROM postgres;
GRANT ALL ON SCHEMA public TO postgres;
GRANT ALL ON SCHEMA public TO PUBLIC;


--
-- PostgreSQL database dump complete
--

