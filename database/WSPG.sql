/****** Object:  Table [dbo].[data_material_in_mlr_wide_strip]    Script Date: 08/06/2023 12:48:11 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[data_material_in_mlr_wide_strip](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[id_lhp_ws] [int] NULL,
	[type] [varchar](50) NULL,
	[qty] [int] NULL,
	[created_at] [datetime] NULL,
 CONSTRAINT [PK_data_material_in_mlr_wide_strip] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[data_material_in_wide_strip]    Script Date: 08/06/2023 12:48:11 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[data_material_in_wide_strip](
	[id_material_in] [int] IDENTITY(1,1) NOT NULL,
	[id_lhp_ws] [int] NULL,
	[material_in] [varchar](50) NULL,
	[qty] [int] NULL,
	[item_material_in] [varchar](50) NULL,
	[created_at] [datetime] NULL,
 CONSTRAINT [PK_data_material_in_wide_strip] PRIMARY KEY CLUSTERED 
(
	[id_material_in] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[detail_breakdown_punching]    Script Date: 08/06/2023 12:48:11 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[detail_breakdown_punching](
	[id_breakdown_punching] [int] IDENTITY(1,1) NOT NULL,
	[id_lhp_punching] [int] NULL,
	[id_detail_lhp_punching] [int] NULL,
	[jam_start] [time](7) NULL,
	[jam_end] [time](7) NULL,
	[type_grid] [varchar](50) NULL,
	[kategori_line_stop] [varchar](50) NULL,
	[jenis_line_stop] [varchar](50) NULL,
	[uraian_line_stop] [varchar](50) NULL,
	[menit_breakdown] [int] NULL,
	[created_at] [datetime] NULL,
 CONSTRAINT [PK_detail_breakdown_punching] PRIMARY KEY CLUSTERED 
(
	[id_breakdown_punching] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[detail_breakdown_wide_strip]    Script Date: 08/06/2023 12:48:11 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[detail_breakdown_wide_strip](
	[id_breakdown_ws] [int] IDENTITY(1,1) NOT NULL,
	[id_lhp_ws] [int] NULL,
	[id_detail_lhp_ws] [int] NULL,
	[jam_start] [time](7) NULL,
	[jam_end] [time](7) NULL,
	[coil_code] [varchar](50) NULL,
	[kategori_line_stop] [varchar](50) NULL,
	[jenis_line_stop] [varchar](50) NULL,
	[tiket_andon] [varchar](10) NULL,
	[uraian_line_stop] [text] NULL,
	[menit_breakdown] [int] NULL,
	[created_at] [datetime] NULL,
 CONSTRAINT [PK_detail_breakdown_wide_strip] PRIMARY KEY CLUSTERED 
(
	[id_breakdown_ws] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[detail_level_melting_pot_wide_strip]    Script Date: 08/06/2023 12:48:11 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[detail_level_melting_pot_wide_strip](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[id_lhp_ws] [int] NULL,
	[no] [int] NULL,
	[melting_pot] [varchar](50) NULL,
	[awal_shift] [float] NULL,
	[akhir_shift] [float] NULL,
	[created_at] [datetime] NULL,
 CONSTRAINT [PK_detail_level_melting_pot_wide_strip] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[detail_lhp_punching]    Script Date: 08/06/2023 12:48:11 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[detail_lhp_punching](
	[id_detail_lhp_punching] [int] IDENTITY(1,1) NOT NULL,
	[id_lhp_punching] [int] NULL,
	[batch] [int] NULL,
	[jam_start] [time](7) NULL,
	[jam_end] [time](7) NULL,
	[menit_tersedia] [smallint] NULL,
	[menit_actual] [smallint] NULL,
	[menit_terpakai] [int] NULL,
	[type_grid] [varchar](50) NULL,
	[ct] [float] NULL,
	[plan_punching] [int] NULL,
	[actual] [int] NULL,
	[total_stop] [int] NULL,
	[created_at] [datetime] NULL,
 CONSTRAINT [PK_detail_lhp_punching] PRIMARY KEY CLUSTERED 
(
	[id_detail_lhp_punching] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[detail_lhp_punching_note]    Script Date: 08/06/2023 12:48:11 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[detail_lhp_punching_note](
	[id_detail_lhp_punching_note] [int] IDENTITY(1,1) NOT NULL,
	[id_lhp_punching] [int] NULL,
	[type_grid] [varchar](50) NULL,
	[note] [text] NULL,
 CONSTRAINT [PK_detail_lhp_punching_note] PRIMARY KEY CLUSTERED 
(
	[id_detail_lhp_punching_note] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY] TEXTIMAGE_ON [PRIMARY]
GO
/****** Object:  Table [dbo].[detail_lhp_wide_strip]    Script Date: 08/06/2023 12:48:11 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[detail_lhp_wide_strip](
	[id_detail_lhp_wide_strip] [int] IDENTITY(1,1) NOT NULL,
	[id_lhp_ws] [int] NULL,
	[batch] [int] NULL,
	[jam_start] [time](7) NULL,
	[jam_end] [time](7) NULL,
	[menit_tersedia] [smallint] NULL,
	[menit_actual] [smallint] NULL,
	[menit_terpakai] [int] NULL,
	[coil_code] [varchar](50) NULL,
	[type_wist] [varchar](50) NULL,
	[ct] [float] NULL,
	[plan_ws] [int] NULL,
	[actual] [int] NULL,
	[total_stop] [int] NULL,
	[created_at] [datetime] NULL,
 CONSTRAINT [PK_detail_lhp_wide_strip] PRIMARY KEY CLUSTERED 
(
	[id_detail_lhp_wide_strip] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[lhp_punching]    Script Date: 08/06/2023 12:48:11 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[lhp_punching](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[date_production] [date] NULL,
	[line] [varchar](50) NULL,
	[shift] [int] NULL,
	[kasubsie] [varchar](50) NULL,
	[grup] [varchar](50) NULL,
	[mp] [int] NULL,
	[absen] [int] NULL,
	[cuti] [int] NULL,
	[total_plan] [int] NULL,
	[total_aktual] [int] NULL,
	[total_breakdown] [int] NULL,
	[total_stop] [int] NULL,
	[created_at] [datetime] NULL,
 CONSTRAINT [PK_lhp_punching] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[lhp_wide_strip]    Script Date: 08/06/2023 12:48:11 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[lhp_wide_strip](
	[id_lhp_ws] [int] IDENTITY(1,1) NOT NULL,
	[tanggal_produksi] [date] NULL,
	[shift] [varchar](50) NULL,
	[kasubsie] [varchar](50) NULL,
	[grup] [varchar](50) NULL,
	[mp] [int] NULL,
	[absen] [int] NULL,
	[cuti] [int] NULL,
	[total_plan] [int] NULL,
	[total_aktual] [float] NULL,
	[total_breakdown] [int] NULL,
	[total_stop] [int] NULL,
	[created_at] [datetime] NULL,
 CONSTRAINT [PK_lhp_wide_strip] PRIMARY KEY CLUSTERED 
(
	[id_lhp_ws] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[master_line_stop_punching]    Script Date: 08/06/2023 12:48:11 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[master_line_stop_punching](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[kategori_line_stop] [varchar](50) NULL,
	[jenis_line_stop] [varchar](50) NULL,
 CONSTRAINT [PK_master_line_stop_punching] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[master_line_stop_wide_strip]    Script Date: 08/06/2023 12:48:11 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[master_line_stop_wide_strip](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[kategori_line_stop] [varchar](50) NULL,
	[jenis_line_stop] [varchar](50) NULL,
 CONSTRAINT [PK_master_line_stop_wide_strip] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[data_master_coil]    Script Date: 08/06/2023 12:45:17 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[data_master_coil](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[coil_code] [varchar](50) NULL,
	[berat] [float] NULL,
 CONSTRAINT [PK_data_master_coil\] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[detail_barcode_coil]    Script Date: 08/06/2023 12:45:17 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[detail_barcode_coil](
	[id] [int] IDENTITY(1,1) NOT NULL,
	[barcode] [varchar](50) NULL,
	[coil_code] [varchar](50) NULL,
	[item] [varchar](50) NULL,
	[berat] [float] NULL,
	[descrp] [varchar](50) NULL,
	[satuan] [varchar](50) NULL,
	[qty] [int] NULL,
	[mesin] [varchar](50) NULL,
	[entry_date] [date] NULL,
	[no_wo] [varchar](50) NULL,
 CONSTRAINT [PK_detail_barcode_coil] PRIMARY KEY CLUSTERED 
(
	[id] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[detail_record_coil]    Script Date: 08/06/2023 12:45:17 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[detail_record_coil](
	[id_log] [int] IDENTITY(1,1) NOT NULL,
	[id_lhp_wh_start] [int] NULL,
	[id_lhp_wh_end] [int] NULL,
	[barcode] [varchar](50) NULL,
	[coil_code] [varchar](50) NULL,
	[type] [varchar](50) NULL,
	[item] [varchar](50) NULL,
	[qty] [int] NULL,
	[winder] [int] NULL,
	[panjang] [float] NULL,
	[tebal_r] [float] NULL,
	[tebal_l] [float] NULL,
	[bending] [float] NULL,
	[lebar] [float] NULL,
	[hasil_timbangan] [float] NULL,
	[prod_time] [date] NULL,
	[berat] [float] NULL,
	[wh_from] [varchar](50) NULL,
	[wh_to] [varchar](50) NULL,
	[supply_time] [datetime] NULL,
	[close_time] [datetime] NULL,
	[status] [varchar](50) NULL,
	[created_at] [datetime] NULL,
 CONSTRAINT [PK_detail_record_coil] PRIMARY KEY CLUSTERED 
(
	[id_log] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
/****** Object:  Table [dbo].[detail_record_coil_sisa]    Script Date: 08/06/2023 12:45:17 ******/
SET ANSI_NULLS ON
GO
SET QUOTED_IDENTIFIER ON
GO
CREATE TABLE [dbo].[detail_record_coil_sisa](
	[id_log] [int] IDENTITY(1,1) NOT NULL,
	[id_lhp_wh_start] [int] NULL,
	[id_lhp_wh_end] [int] NULL,
	[barcode] [varchar](50) NULL,
	[coil_code] [varchar](50) NULL,
	[type] [varchar](50) NULL,
	[item] [varchar](50) NULL,
	[qty] [int] NULL,
	[winder] [int] NULL,
	[panjang] [float] NULL,
	[tebal_r] [float] NULL,
	[tebal_l] [float] NULL,
	[bending] [float] NULL,
	[lebar] [float] NULL,
	[hasil_timbangan] [float] NULL,
	[prod_time] [date] NULL,
	[berat] [float] NULL,
	[wh_from] [varchar](50) NULL,
	[wh_to] [varchar](50) NULL,
	[supply_time] [datetime] NULL,
	[close_time] [datetime] NULL,
	[status] [varchar](50) NULL,
	[created_at] [datetime] NULL,
 CONSTRAINT [PK_detail_record_coil_sisa] PRIMARY KEY CLUSTERED 
(
	[id_log] ASC
)WITH (PAD_INDEX = OFF, STATISTICS_NORECOMPUTE = OFF, IGNORE_DUP_KEY = OFF, ALLOW_ROW_LOCKS = ON, ALLOW_PAGE_LOCKS = ON, OPTIMIZE_FOR_SEQUENTIAL_KEY = OFF) ON [PRIMARY]
) ON [PRIMARY]
GO
SET IDENTITY_INSERT [dbo].[data_master_coil] ON 

INSERT [dbo].[data_master_coil] ([id], [coil_code], [berat]) VALUES (1, N'CWN001', NULL)
INSERT [dbo].[data_master_coil] ([id], [coil_code], [berat]) VALUES (2, N'CWN002', NULL)
INSERT [dbo].[data_master_coil] ([id], [coil_code], [berat]) VALUES (3, N'CWN003', NULL)
INSERT [dbo].[data_master_coil] ([id], [coil_code], [berat]) VALUES (4, N'CWN004', NULL)
INSERT [dbo].[data_master_coil] ([id], [coil_code], [berat]) VALUES (5, N'CWN005', NULL)
INSERT [dbo].[data_master_coil] ([id], [coil_code], [berat]) VALUES (6, N'CWN006', NULL)
INSERT [dbo].[data_master_coil] ([id], [coil_code], [berat]) VALUES (7, N'CWN007', NULL)
INSERT [dbo].[data_master_coil] ([id], [coil_code], [berat]) VALUES (8, N'CWN008', NULL)
INSERT [dbo].[data_master_coil] ([id], [coil_code], [berat]) VALUES (9, N'CWN009', NULL)
INSERT [dbo].[data_master_coil] ([id], [coil_code], [berat]) VALUES (10, N'CWN010', NULL)
INSERT [dbo].[data_master_coil] ([id], [coil_code], [berat]) VALUES (11, N'CWN011', NULL)
INSERT [dbo].[data_master_coil] ([id], [coil_code], [berat]) VALUES (12, N'CWN012', NULL)
INSERT [dbo].[data_master_coil] ([id], [coil_code], [berat]) VALUES (13, N'CWN013', NULL)
INSERT [dbo].[data_master_coil] ([id], [coil_code], [berat]) VALUES (14, N'CWN014', NULL)
INSERT [dbo].[data_master_coil] ([id], [coil_code], [berat]) VALUES (15, N'CWN015', NULL)
INSERT [dbo].[data_master_coil] ([id], [coil_code], [berat]) VALUES (16, N'CWN016', NULL)
INSERT [dbo].[data_master_coil] ([id], [coil_code], [berat]) VALUES (17, N'CWN017', NULL)
INSERT [dbo].[data_master_coil] ([id], [coil_code], [berat]) VALUES (18, N'CWN018', NULL)
INSERT [dbo].[data_master_coil] ([id], [coil_code], [berat]) VALUES (19, N'CWN019', NULL)
INSERT [dbo].[data_master_coil] ([id], [coil_code], [berat]) VALUES (20, N'CWN020', NULL)
SET IDENTITY_INSERT [dbo].[data_master_coil] OFF
GO